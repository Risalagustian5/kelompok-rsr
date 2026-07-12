<?php

namespace App\Http\Controllers; // pastikan namespace sesuai folder

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // penting: extend Controller
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Simpan foto villa ke storage dan database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'photo'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'villa_id' => 'required|exists:villas,id',
        ]);

        // Upload file ke storage/app/public/villa_photos
        $file     = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path     = $file->storeAs('villa_photos', $filename, 'public');

        // Simpan ke database
        Photo::create([
            'filename' => $filename,
            'path'     => $path,
            'villa_id' => $request->villa_id,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Foto berhasil diupload!');
    }
}
