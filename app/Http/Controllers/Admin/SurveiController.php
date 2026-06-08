<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest; // Menggunakan model Guest

class SurveiController extends Controller
{
    public function index()
    {
        // Hanya menghitung tamu yang sudah mengisi kepuasan (mencegah error dari data lama)
        $totalSurveys = Guest::whereNotNull('kepuasan')->count();
        
        $totalPuas = Guest::where('kepuasan', 'Puas')->count();
        $totalTidakPuas = Guest::where('kepuasan', 'Tidak Puas')->count();
        
        $persentasePuas = $totalSurveys > 0 ? ($totalPuas / $totalSurveys) * 100 : 0;

        // Mengambil daftar tamu yang ada data kepuasannya
        $surveys = Guest::whereNotNull('kepuasan')->latest()->paginate(10);

        return view('admin.survei.index', compact('totalSurveys', 'totalPuas', 'totalTidakPuas', 'persentasePuas', 'surveys'));
    }
}