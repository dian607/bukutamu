<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'instansi', 
        'no_hp', 
        'email', 
        'tujuan', 
        'catatan', 
        'ttd',
        'kepuasan',
        'saran' 
    ];
}