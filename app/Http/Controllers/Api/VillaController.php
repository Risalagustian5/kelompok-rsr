<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Auth; // <--- TAMBAHKAN INI (Untuk cek user login)
use App\Models\Villa;
use App\Models\Booking;              // <--- TAMBAHKAN INI (Biar error not found hilang)

class VillaController extends Controller
{
    // ... (kode lainnya biarkan saja)
    // --- RUTE USER (Booking & History) ---

    // 1. Melihat Riwayat Pesanan
  public function historyBooking() {
    // Tambahkan ->with('villa') di sini
    $bookings = Booking::where('user_id', Auth::id())
                       ->with('villa') 
                       ->orderBy('created_at', 'desc')
                       ->get();
    return view('user.villas.history', compact('bookings'));
}

// 3. Membatalkan pesanan (khusus User)
    public function userCancelBooking($id) {
        $booking = Booking::findOrFail($id);

        // Keamanan: Cuma yang punya pesanan yang bisa batalin
        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak berhak membatalkan pesanan ini.');
        }

        // Kalau udah dikonfirmasi admin, nggak bisa dibatalin
        if ($booking->status === 'confirmed') {
            return back()->with('error', 'Pesanan sudah dikonfirmasi, tidak dapat dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // --- RUTE VILLA (User View) ---

    public function index() {
        $villas = Villa::all();
        return view('user.villas.index', compact('villas')); 
    }

  // 1. Menampilkan detail satu villa
    public function show($id)
    {
        $villa = Villa::findOrFail($id);
        
        // Mengarah ke resources/views/user/villas/show.blade.php
        return view('user.villas.show', compact('villa'));
    }

   
    // --- RUTE ADMIN (Villa Management) ---

   public function adminIndex() {
    $villas = Villa::all(); // Pastikan ini mengambil data dari Model
    return view('admin.Villas.index', compact('villas'));
    }

    public function adminBookings() {
        $bookings = Booking::with(['user', 'villa'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking($id) {
        Booking::findOrFail($id)->update(['status' => 'confirmed']);
        return back()->with('success', 'Pesanan dikonfirmasi');
    }

    public function cancelBooking($id) {
        Booking::findOrFail($id)->update(['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    public function destroyBooking($id) {
        Booking::findOrFail($id)->delete();
        return back()->with('success', 'Pesanan dihapus');
    }

   public function create() { 
    return view('admin.villas.create'); 
    }

   // Di dalam VillaController.php

public function store(Request $request) {
    $request->validate([
        'nama_villa' => 'required',
        'harga'      => 'required',
        'foto'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // Simpan file ke folder storage/app/public/villas
    $path = $request->file('foto')->store('villas', 'public');

    // Gunakan 'foto_url' sesuai dengan isi $fillable di Villa.php
    \App\Models\Villa::create([
        'nama_villa' => $request->nama_villa,
        'harga'      => str_replace('.', '', $request->harga),
        'lokasi'     => $request->lokasi,
        'deskripsi'  => $request->deskripsi,
        'foto_url'   => $path, // <--- UBAH DARI 'foto' MENJADI 'foto_url'
    ]);

    return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil ditambah!');
}

    public function edit($id) {
        $villa = Villa::findOrFail($id);
        return view('admin.villas.edit', compact('villa'));
    }

   public function update(Request $request, $id)
{
    // 1. Validasi input
    $request->validate([
        'nama_villa' => 'required',
        'harga'      => 'required',
        'foto'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // foto bersifat nullable (boleh kosong saat update)
    ]);

    $villa = \App\Models\Villa::findOrFail($id);

    // 2. Cek apakah ada file foto baru yang diupload
    if ($request->hasFile('foto')) {
        // Hapus file lama jika perlu (opsional)
        // \Storage::disk('public')->delete($villa->foto_url);

        // Upload file baru
        $path = $request->file('foto')->store('villas', 'public');
        $data['foto_url'] = $path;
    } else {
        // Jika tidak ada file baru, tetap gunakan foto yang lama
        $data['foto_url'] = $villa->foto_url;
    }

    // 3. Update data lainnya
    $data['nama_villa'] = $request->nama_villa;
    $data['harga']      = str_replace('.', '', $request->harga);
    $data['lokasi']     = $request->lokasi;
    $data['deskripsi']  = $request->deskripsi;

    $villa->update($data);

    return redirect()->route('admin.villas.index')->with('success', 'Data villa berhasil diupdate!');
    }

    public function destroy($id) {
        Villa::findOrFail($id)->delete();
        return redirect()->route('admin.villas.index')->with('success', 'Villa dihapus');
    }

    public function book($id) {
        $villa = Villa::findOrFail($id);
        return view('user.villas.book', ['villa' => $villa]);
    }
    // 2. Memproses Booking dari form user
    public function storeBooking(Request $request, $id) {
        $request->validate([
            'check_in'    => 'required|date|after_or_equal:today',
            'check_out'   => 'required|date|after:check_in',
            'jumlah_tamu' => 'required|integer|min:1', 
        ]);

        $villa = Villa::findOrFail($id);

        Booking::create([
            'user_id'     => Auth::id(), 
            'villa_id'    => $villa->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status'      => 'pending', 
        ]);

        return redirect()->route('history')->with('success', 'Berhasil memesan villa! Menunggu konfirmasi admin.');
    }

    
}