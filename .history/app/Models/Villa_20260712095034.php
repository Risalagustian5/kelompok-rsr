<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $table = 'villas';

    protected $fillable = [
        'nama_villa',
        'harga',
        'lokasi',
        'deskripsi',
        'foto_url',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function photos()
{
    return $this->hasMany(Photo::class);
}

}
