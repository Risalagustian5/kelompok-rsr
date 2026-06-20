<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    // Nama tabel (opsional, default = 'villas')
    protected $table = 'villas';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama_villa',
        'harga',
        'lokasi',
        'deskripsi',
        'foto_url',
    ];

    // Relasi: satu villa bisa punya banyak booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
