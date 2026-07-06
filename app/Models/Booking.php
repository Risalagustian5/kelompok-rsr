<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'villa_id', 'check_in', 'check_out', 'jumlah_tamu', 'status'];

    public function user() { return $this->belongsTo(User::class); }
public function villa() { return $this->belongsTo(Villa::class); }
}