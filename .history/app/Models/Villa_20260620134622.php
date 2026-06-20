<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $fillable = ['nama_villa', 'harga', 'lokasi', 'deskripsi', 'foto_url'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}