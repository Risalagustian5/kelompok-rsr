<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Kunci utama buat nembak API Supabase

class VillaController extends Controller
{
    // ==========================================
    // 👥 BAGIAN USER / TAMU
    // ==========================================
    
    // 1. Menampilkan Halaman Daftar Villa untuk Tamu
    public function index()
    {
        // Mengambil semua data villa dari DB MySQL lokal
        $villas = Villa::all(); 
        return view('user.villas.index', compact('villas'));
    }

    // 2. Menampilkan Detail Villa pas diklik oleh Tamu
    public function show($id)
    {
        // Pastikan variabelnya $villa (sesuai yang dipanggil di view show.blade.php)
        $villa = Villa::findOrFail($id);
        return view('user.villas.show', compact('villa'));
    }


    // ==========================================
    // 👨‍✈️ BAGIAN ADMIN (CRUD LENGKAP VIA API)
    // ==========================================

    // 3. Halaman Utama Admin (Tabel List Villa)
    public function adminIndex()
    {
        $villas = Villa::all();
        return view('admin.villas.index', compact('villas'));
    }

    // 4. Menampilkan Form Tambah Villa Baru
    public function create()
    {
        return view('admin.villas.create');
    }

    // 5. Proses Simpan Villa + HIT API SUPABASE STORAGE (CREATE)
    public function store(Request $request)
    {
        // Validasi inputan form admin
        $request->validate([
            'nama_villa' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // --- PROSES HIT API SUPABASE STORAGE ---
        $file = $request->file('foto');
        $fileName = time() . '_' . str_replace(' ', '%20', $file->getClientOriginalName());
        $fileBinary = file_get_contents($file);

        // Satuin URL API Supabase dengan nama file buat disimpen di bucket 'villas'
        $supabaseUrl = env('SUPABASE_URL') . '/storage/v1/object/villas/' . $fileName;
        $supabaseKey = env('SUPABASE_KEY');

        // Tembak API Supabase pake HTTP Client bawaan Laravel
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $supabaseKey,
            'apikey' => $supabaseKey,
            'Content-Type' => $file->getClientMimeType(),
        ])->send('POST', $supabaseUrl, [
            'body' => $fileBinary
        ]);

        // Kalau API Supabase nolak/gagal
        if ($response->failed()) {
            return back()->with('error', 'Gagal upload foto ke API Supabase, brok!');
        }

        // Kalau sukses, dapatkan URL foto publiknya dari Supabase
        $publicFotoUrl = env('SUPABASE_URL') . '/storage/v1/object/public/villas/' . $fileName;

        // --- SIMPAN DATA KE DATABASE LOKAL (MySQL) ---
        Villa::create([
            'nama_villa' => $request->nama_villa,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto_url' => $publicFotoUrl, // URL dari cloud Supabase disimpen di sini
        ]);

        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil ditambah via API Supabase!');
    }

    // 6. Menampilkan Form Edit Villa (EDIT)
    public function edit($id)
    {
        $villa = Villa::findOrFail($id);
        return view('admin.villas.edit', compact('villa'));
    }

    // 7. Proses Perbarui Villa + Sync API Supabase jika ganti foto (UPDATE)
    public function update(Request $request, $id)
    {
        $villa = Villa::findOrFail($id);

        $request->validate([
            'nama_villa' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $publicFotoUrl = $villa->foto_url; // Default pake foto lama dulu

        // Kalau si admin mengunggah file foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . str_replace(' ', '%20', $file->getClientOriginalName());
            $fileBinary = file_get_contents($file);

            $supabaseUrl = env('SUPABASE_URL') . '/storage/v1/object/villas/' . $fileName;
            $supabaseKey = env('SUPABASE_KEY');

            // Tembak file barunya ke Supabase API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $supabaseKey,
                'apikey' => $supabaseKey,
                'Content-Type' => $file->getClientMimeType(),
            ])->send('POST', $supabaseUrl, [
                'body' => $fileBinary
            ]);

            if ($response->successful()) {
                $publicFotoUrl = env('SUPABASE_URL') . '/storage/v1/object/public/villas/' . $fileName;
            }
        }

        // Update data MySQL lokal
        $villa->update([
            'nama_villa' => $request->nama_villa,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto_url' => $publicFotoUrl,
        ]);

        return redirect()->route('admin.villas.index')->with('success', 'Data villa berhasil diperbarui!');
    }

    // 8. Proses Hapus Villa (DELETE)
    public function destroy($id)
    {
        $villa = Villa::findOrFail($id);
        $villa->delete();

        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil dihapus!');
    }
}