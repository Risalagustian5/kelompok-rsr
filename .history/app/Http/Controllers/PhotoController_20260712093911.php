<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'villa_id' => 'required|exists:villas,id',
        ]);

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('villa_photos', $filename, 'public');

        Photo::create([
            'filename' => $filename,
            'path' => $path,
            'villa_id' => $request->villa_id,
        ]);

        return back()->with('success', 'Foto berhasil diupload!');
    }
}
