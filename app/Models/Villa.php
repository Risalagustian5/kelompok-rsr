<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    // Ini biar Laravel ijinin kita buat masukin data lewat form/API nanti
    protected $fillable = [
        'nama_villa', 
        'harga', 
        'lokasi', 
        'deskripsi', 
        'foto_url'
    ];
}