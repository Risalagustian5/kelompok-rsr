<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VillaController extends Controller
{
    protected $supabaseUrl, $supabaseKey;

    public function __construct() {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    private function client() {
        return Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation'
        ]);
    }

    public function adminIndex() {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?select=*');
        $villas = $response->successful() ? $response->json() : [];
        return view('admin.villas.index', compact('villas'));
    }

    // --- TAMBAHAN BARU: Method adminBookings untuk mengatasi Error ---
    public function adminBookings() {
        // Asumsi mengambil data dari tabel 'bookings' di Supabase
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/bookings?select=*');
        $bookings = $response->successful() ? $response->json() : [];
        
        // Sesuaikan nama view ini dengan struktur folder Anda, misalnya: resources/views/admin/bookings/index.blade.php
        return view('admin.bookings.index', compact('bookings'));
    }
    // -----------------------------------------------------------------

    public function create() {
        return view('admin.villas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_villa' => 'required|string|max:255',
            'lokasi'     => 'required|string|max:255',
            'harga'      => 'required|numeric',
            'deskripsi'  => 'nullable|string',
            'foto'       => 'required|image|max:2048'
        ]);

        $file = $request->file('foto');
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

        $upload = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => $file->getMimeType()
        ])->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
          ->post($this->supabaseUrl . '/storage/v1/object/villas/' . $fileName);

        if ($upload->successful()) {
            $this->client()->post($this->supabaseUrl . '/rest/v1/villas', [
                'nama_villa' => $request->nama_villa,
                'lokasi'     => $request->lokasi,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
                'foto'       => $this->supabaseUrl . '/storage/v1/object/public/villas/' . $fileName
            ]);
            return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil ditambah');
        }
        return back()->withErrors(['foto' => 'Upload Gagal']);
    }

    public function edit($id) {
        $response = $this->client()->get($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        $data = $response->json();
        $villa = (!empty($data)) ? $data[0] : null;
        return view('admin.villas.edit', compact('villa'));
    }

    public function update(Request $request, $id) {
        $data = $request->only(['nama_villa', 'lokasi', 'harga', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            Http::withHeaders([
                'apikey'        => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
                'Content-Type'  => $file->getMimeType()
            ])->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
              ->post($this->supabaseUrl . '/storage/v1/object/villas/' . $fileName);

            $data['foto'] = $this->supabaseUrl . '/storage/v1/object/public/villas/' . $fileName;
        }

        $this->client()->patch($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id, $data);
        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil diupdate');
    }

    public function destroy($id) {
        $this->client()->delete($this->supabaseUrl . '/rest/v1/villas?id=eq.' . $id);
        return redirect()->route('admin.villas.index')->with('success', 'Villa berhasil dihapus');
    }
}