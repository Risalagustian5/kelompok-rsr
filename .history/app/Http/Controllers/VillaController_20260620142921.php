<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class VillaController extends Controller
{
    // --- USER: Lihat Daftar Villa ---
    public function index() {
        $villas = Villa::all();
        return view('user.villas.index', compact('villas'));
    }

    // --- USER: Lihat Detail Villa ---
    public function show($id) {
        $villa = Villa::findOrFail($id);
        return view('user.villas.show', compact('villa'));
    }

    // --- USER: Proses Booking ---
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'check_in'    => 'required|date|after_or_equal:today',
            'check_out'   => 'required|date|after:check_in',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        Booking::create([
            'user_id'     => Auth::id(),
            'villa_id'    => $id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status'      => 'pending',
        ]);

        return redirect()->route('history')->with('success', 'Booking berhasil! Menunggu konfirmasi admin.');
    }

    // --- USER: Lihat Riwayat Booking ---
    public function historyBooking() {
        $bookings = Booking::where('user_id', Auth::id())->latest()->get();
        return view('user.villas.history', compact('bookings')); 
    }

    // --- ADMIN: Lihat Daftar Pesanan ---
    public function adminBookings() {
        $bookings = Booking::with('user', 'villa')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // --- ADMIN: Konfirmasi Pesanan ---
    public function confirmBooking($id) {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);
        return back()->with('success', 'Pesanan telah dikonfirmasi!');
    }

    // --- ADMIN: Daftar Villa ---
    public function adminIndex() {
        $villas = Villa::all();
        return view('admin.villas.index', compact('villas'));
    }

    public function create() {
        return view('admin.villas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_villa' => 'required',
            'harga'      => 'required|numeric',
            'lokasi'     => 'required',
            'foto'       => 'required|image|max:2048',
        ]);

        // --- Upload ke Supabase Storage ---
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $supabaseUrl = env('SUPABASE_URL') . '/storage/v1/object/villas/' . $fileName;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            'apikey'        => env('SUPABASE_KEY'),
            'Content-Type'  => $file->getClientMimeType(),
        ])->send('POST', $supabaseUrl, [
            'body' => file_get_contents($file),
        ]);

        if ($response->failed()) {
            return back()->with('error', 'Gagal upload foto ke Supabase!');
        }

        $publicFotoUrl = env('SUPABASE_URL') . '/storage/v1/object/public/villas/' . $fileName;

        // --- Simpan ke MySQL Lokal ---
        $villa = Villa::create([
            'nama_villa' => $request->nama_villa,
            'harga'      => $request->harga,
            'lokasi'     => $request->lokasi,
            'deskripsi'  => $request->deskripsi,
            'foto_url'   => $publicFotoUrl,
        ]);

        // --- Simpan juga ke Supabase Database (Postgres) ---
        Http::withHeaders([
            'apikey'        => env('SUPABASE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            'Content-Type'  => 'application/json',
        ])->post(env('SUPABASE_URL') . '/rest/v1/villas', [
            'nama_villa' => $request->nama_villa,
            'harga'      => $request->harga,
            'lokasi'     => $request->lokasi,
            'deskripsi'  => $request->deskripsi,
            'foto_url'   => $publicFotoUrl,
        ]);

        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil ditambah!');
    }

    public function edit($id) {
        $villa = Villa::findOrFail($id);
        return view('admin.villas.edit', compact('villa'));
    }

    public function update(Request $request, $id) {
        $villa = Villa::findOrFail($id);
        $villa->update($request->except('foto'));
        return redirect()->route('admin.villas.index')->with('success', 'Data villa diperbarui!');
    }

    public function destroy($id) {
        Villa::findOrFail($id)->delete();
        return redirect()->route('admin.villas.index')->with('success', 'Villa dihapus!');
    }
}
