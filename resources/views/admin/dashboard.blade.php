@extends('layouts.admin')
@section('title', 'Dashboard - Admin Buku Tamu')
@section('page_title', 'Overview Dashboard')

@push('styles')
<style>
    /* Card Premium UI */
    .stat-card { border: none; border-radius: 20px; padding: 25px; transition: transform 0.3s; position: relative; overflow: hidden; }
    .stat-card:hover { transform: translateY(-5px); }
    .card-dark { background: linear-gradient(135deg, #111827 0%, #1f2937 100%); color: white; box-shadow: 0 10px 25px rgba(17,24,39,0.3); }
    .card-white { background: white; color: #1f2937; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    
    .stat-title { font-size: 0.9rem; font-weight: 600; opacity: 0.8; margin-bottom: 10px; }
    .stat-value { font-size: 2.2rem; font-weight: 800; line-height: 1; margin-bottom: 10px; }
    .stat-icon { position: absolute; right: 20px; top: 20px; font-size: 3rem; opacity: 0.1; }
    
    /* Grafik & Tabel Container */
    .panel-container { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; margin-top: 25px; }
    .panel-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .panel-title { font-weight: 700; font-size: 1.1rem; color: #111827; }
    
    /* Tabel Modern */
    .table-modern { margin: 0; }
    .table-modern th { background: #f9fafb; color: #6b7280; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb; padding: 15px; }
    .table-modern td { padding: 15px; vertical-align: middle; color: #374151; font-weight: 500; border-bottom: 1px solid #f3f4f6; }
    .badge-status { background: #e0f2fe; color: #0284c7; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="stat-card card-dark">
            <i class="bi bi-people-fill stat-icon text-white"></i>
            <div class="stat-title">Total Tamu (Bulan Ini)</div>
            <div class="stat-value">{{ $tamuBulanIni }}</div>
            <div class="text-success fw-bold" style="font-size: 0.85rem;"><i class="bi bi-graph-up-arrow"></i> Sistem Aktif</div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card card-white">
            <i class="bi bi-person-plus-fill stat-icon text-success"></i>
            <div class="stat-title">Tamu Hari Ini</div>
            <div class="stat-value text-dark">{{ $tamuHariIni }}</div>
            <div class="text-muted" style="font-size: 0.85rem;"><i class="bi bi-clock-history"></i> Real-time hari ini</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-white">
            <i class="bi bi-star-fill stat-icon text-warning"></i>
            <div class="stat-title">Rata-rata Kepuasan</div>
            <div class="stat-value text-dark">{{ $rataKepuasan }} <span class="fs-5 text-muted">/ 5.0</span></div>
            <div class="text-warning fw-bold" style="font-size: 0.85rem;"><i class="bi bi-stars"></i> Sangat Baik</div>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col-lg-7">
        <div class="panel-container h-100">
            <div class="panel-header">
                <div class="panel-title">Grafik Kunjungan (7 Hari Terakhir)</div>
            </div>
            <canvas id="kunjunganChart" height="120"></canvas>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="panel-container h-100">
            <div class="panel-header">
                <div class="panel-title">Tamu Terbaru</div>
                <a href="{{ route('admin.bukutamu.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold"><i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-modern table-borderless">
                    <thead>
                        <tr>
                            <th>Nama & Instansi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tamuTerbaru as $tamu)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $tamu->nama }}</div>
                                <div class="text-muted small">{{ $tamu->instansi }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $tamu->created_at->format('d M') }}</div>
                                <div class="text-muted small">{{ $tamu->created_at->format('H:i') }}</div>
                            </td>
                            <td><span class="badge-status">Hadir</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada data tamu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Chart.js
    const ctx = document.getElementById('kunjunganChart').getContext('2d');
    
    // Gradasi Hijau untuk grafik batang
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#66bb6a');
    gradient.addColorStop(1, '#2e7d32');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Tamu',
                data: {!! json_encode($chartTotals) !!},
                backgroundColor: gradient,
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#f3f4f6' }, ticks: { precision: 0 } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush