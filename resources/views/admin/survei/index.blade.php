@extends('layouts.admin')
@section('title', 'Indeks Kepuasan - Admin')
@section('page_title', 'Indeks Kepuasan Masyarakat (IKM)')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; margin-bottom: 25px; }
    
    /* Progress Bar Modern */
    .rating-box { padding: 15px 20px; background: #f8fafc; border-radius: 15px; border: 1px solid #f1f5f9; }
    .rating-label { font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 8px; display: flex; justify-content: space-between; }
    .progress { height: 10px; border-radius: 10px; background-color: #e2e8f0; }
    .progress-bar { background: linear-gradient(90deg, #66bb6a, #2e7d32); border-radius: 10px; }
    
    /* Total Skor Bulat */
    .total-score-box { background: linear-gradient(135deg, #111827 0%, #1f2937 100%); border-radius: 20px; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; padding: 30px; box-shadow: 0 10px 25px rgba(17,24,39,0.2); }
    .score-circle { width: 120px; height: 120px; border-radius: 50%; border: 8px solid rgba(74, 222, 128, 0.3); display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 900; color: #4ade80; margin-bottom: 15px; }
    
    /* Table */
    .table-modern th { background: #f9fafb; color: #6b7280; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; padding: 15px; }
    .table-modern td { padding: 15px; vertical-align: middle; color: #374151; font-weight: 500; border-bottom: 1px solid #f3f4f6; }
    .star-icon { color: #fbbf24; font-size: 0.9rem; }
    .feedback-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 10px 15px; border-radius: 0 8px 8px 0; font-size: 0.85rem; font-style: italic; color: #92400e; }
</style>
@endpush

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="total-score-box">
            <div class="score-circle">{{ number_format($totalAvg, 1) }}</div>
            <h5 class="fw-bold mb-1">Skor Rata-Rata Total</h5>
            <p class="text-muted mb-0 small">Skala Penilaian: 1.0 - 5.0</p>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="panel-container h-100 mb-0">
            <h5 class="fw-bold mb-4 border-bottom pb-3">Rincian Penilaian per Aspek Layanan</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="rating-box">
                        <div class="rating-label"><span><i class="bi bi-headset me-2 text-success"></i>Kualitas Layanan</span> <span>{{ number_format($avgKualitas, 1) }} / 5</span></div>
                        <div class="progress"><div class="progress-bar" style="width: {{ ($avgKualitas / 5) * 100 }}%"></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rating-box">
                        <div class="rating-label"><span><i class="bi bi-building me-2 text-success"></i>Fasilitas</span> <span>{{ number_format($avgFasilitas, 1) }} / 5</span></div>
                        <div class="progress"><div class="progress-bar" style="width: {{ ($avgFasilitas / 5) * 100 }}%"></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rating-box">
                        <div class="rating-label"><span><i class="bi bi-emoji-smile me-2 text-success"></i>Keramahan Staf</span> <span>{{ number_format($avgKeramahan, 1) }} / 5</span></div>
                        <div class="progress"><div class="progress-bar" style="width: {{ ($avgKeramahan / 5) * 100 }}%"></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rating-box">
                        <div class="rating-label"><span><i class="bi bi-clock-history me-2 text-success"></i>Kecepatan</span> <span>{{ number_format($avgKecepatan, 1) }} / 5</span></div>
                        <div class="progress"><div class="progress-bar" style="width: {{ ($avgKecepatan / 5) * 100 }}%"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-container">
    <h5 class="fw-bold mb-4">Daftar Penilaian & Masukan Pengunjung</h5>
    <div class="table-responsive">
        <table class="table table-modern table-hover">
            <thead>
                <tr>
                    <th width="20%">Responden</th>
                    <th width="35%">Nilai Aspek (1-5)</th>
                    <th width="45%">Kritik & Saran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surveys as $survey)
                <tr>
                    <td>
                        <div class="fw-bold text-dark">{{ $survey->nama ?: 'Anonim' }}</div>
                        <div class="text-muted small">{{ $survey->created_at->format('d M Y') }}</div>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-2 small">
                            <span class="badge bg-light text-dark border">Kualitas: <i class="bi bi-star-fill star-icon"></i> {{ $survey->kualitas }}</span>
                            <span class="badge bg-light text-dark border">Fasilitas: <i class="bi bi-star-fill star-icon"></i> {{ $survey->fasilitas }}</span>
                            <span class="badge bg-light text-dark border">Keramahan: <i class="bi bi-star-fill star-icon"></i> {{ $survey->keramahan }}</span>
                            <span class="badge bg-light text-dark border">Kecepatan: <i class="bi bi-star-fill star-icon"></i> {{ $survey->kecepatan }}</span>
                        </div>
                    </td>
                    <td>
                        @if($survey->saran)
                            <div class="feedback-box">"{{ $survey->saran }}"</div>
                        @else
                            <span class="text-muted small fst-italic">Tidak memberikan masukan.</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-5 text-muted">Belum ada data survei masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4 d-flex justify-content-end">
        {{ $surveys->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection