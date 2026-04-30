<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // 1. Data Card Statistik
        $tamuHariIni = Guest::whereDate('created_at', $today)->count();
        $tamuBulanIni = Guest::whereMonth('created_at', $currentMonth)
                             ->whereYear('created_at', $currentYear)->count();
        
        // Menghitung rata-rata dari ke-4 indikator kepuasan
        $rataKepuasan = Survey::selectRaw('(AVG(kualitas) + AVG(fasilitas) + AVG(keramahan) + AVG(kecepatan)) / 4 as total_avg')->value('total_avg');
        $rataKepuasan = $rataKepuasan ? number_format($rataKepuasan, 1) : '0.0';

        // 2. Data Tabel Tamu Terbaru (5 Terakhir)
        $tamuTerbaru = Guest::latest()->take(5)->get();

        // 3. Data Grafik Kunjungan 7 Hari Terakhir
        $grafikData = Guest::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $chartLabels = [];
        $chartTotals = [];
        
        // Memastikan 7 hari terakhir terisi semua meski 0 tamu
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $displayDate = Carbon::now()->subDays($i)->format('d M');
            $chartLabels[] = $displayDate;
            
            $match = $grafikData->firstWhere('tanggal', $date);
            $chartTotals[] = $match ? $match->total : 0;
        }

        return view('admin.dashboard', compact(
            'tamuHariIni', 'tamuBulanIni', 'rataKepuasan', 'tamuTerbaru', 'chartLabels', 'chartTotals'
        ));
    }
}