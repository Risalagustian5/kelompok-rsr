<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'villa_id', 'check_in', 'check_out', 'jumlah_tamu', 'status'];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Villa
    public function villa() {
        return $this->belongsTo(Villa::class);
    }
}