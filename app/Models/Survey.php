<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Perhatikan: Nama class di sini harus Survey (pakai Y) menyesuaikan nama filemu
class Survey extends Model 
{
    use HasFactory;

    // Tabel di database tetap 'surveis'
    protected $table = 'surveis'; 

    protected $fillable = [
        'nama',
        'kepuasan',
        'saran'
    ];
}