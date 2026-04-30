<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;

class SurveiController extends Controller
{
    public function index()
    {
        // Menarik semua data survei dari terbaru
        $surveys = Survey::latest()->paginate(10);

        // Menghitung rata-rata masing-masing aspek
        $avgKualitas = Survey::avg('kualitas') ?? 0;
        $avgFasilitas = Survey::avg('fasilitas') ?? 0;
        $avgKeramahan = Survey::avg('keramahan') ?? 0;
        $avgKecepatan = Survey::avg('kecepatan') ?? 0;

        // Menghitung total rata-rata keseluruhan
        $totalAvg = ($avgKualitas + $avgFasilitas + $avgKeramahan + $avgKecepatan) / 4;

        return view('admin.survei.index', compact(
            'surveys', 'avgKualitas', 'avgFasilitas', 'avgKeramahan', 'avgKecepatan', 'totalAvg'
        ));
    }
}