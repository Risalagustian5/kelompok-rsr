<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <--- INI WAJIB DITAMBAHKAN
use App\Models\Villa;

class VillaController extends Controller
{
    // --- RUTE USER (Booking & History) ---

    public function historyBooking() {
        // Mengambil booking milik user yang sedang login beserta data villanya
        $bookings = Booking::where('user_id', Auth::id())->with('villa')->get();
        return view('user.villas.history', compact('bookings'));
    }

    public function userCancelBooking($id) {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Pesanan dibatalkan');
    }

    // --- RUTE VILLA (User View) ---

    public function index() {
        $villas = Villa::all();
        return view('user.villas.index', compact('villas')); 
    }

    public function show($id) {
        $villa = Villa::findOrFail($id);
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
}