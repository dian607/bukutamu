<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $tamuHariIni = Guest::whereDate('created_at', $today)->count();
        $tamuBulanIni = Guest::whereMonth('created_at', $currentMonth)
                             ->whereYear('created_at', $currentYear)->count();
        
        // Membaca status kepuasan langsung dari tabel tamu (Guest)
        $totalPuas = Guest::where('kepuasan', 'Puas')->count();
        $totalTidakPuas = Guest::where('kepuasan', 'Tidak Puas')->count();

        $tamuTerbaru = Guest::latest()->take(5)->get();

        $grafikData = Guest::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $chartLabels = [];
        $chartTotals = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $displayDate = Carbon::now()->subDays($i)->format('d M');
            $chartLabels[] = $displayDate;
            
            $match = $grafikData->firstWhere('tanggal', $date);
            $chartTotals[] = $match ? $match->total : 0;
        }

        return view('admin.dashboard', compact(
            'tamuHariIni', 'tamuBulanIni', 'totalPuas', 'totalTidakPuas', 'tamuTerbaru', 'chartLabels', 'chartTotals'
        ));
    }
}