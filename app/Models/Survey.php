<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi data
    protected $fillable = [
        'nama',
        'kualitas',
        'fasilitas',
        'keramahan',
        'kecepatan',
        'saran'
    ];
}