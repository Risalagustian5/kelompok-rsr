<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'villa_id',
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
