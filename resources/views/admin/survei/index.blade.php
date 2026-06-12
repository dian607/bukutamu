@extends('layouts.admin')
@section('title', 'Indeks Kepuasan - Admin')
@section('page_title', 'Indeks Kepuasan Masyarakat (IKM)')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; margin-bottom: 25px; }
    .stat-box { padding: 20px; border-radius: 15px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 15px; background: #f8fafc; }
    .stat-icon-wrapper { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; }
    .total-score-box { background: linear-gradient(135deg, #111827 0%, #1f2937 100%); border-radius: 20px; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; padding: 30px; box-shadow: 0 10px 25px rgba(17,24,39,0.2); }
    .score-circle { width: 120px; height: 120px; border-radius: 50%; border: 8px solid rgba(74, 222, 128, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 900; color: #4ade80; margin-bottom: 15px; }
    .table-modern th { background: #f9fafb; color: #6b7280; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; padding: 15px; }
    .table-modern td { padding: 15px; vertical-align: middle; color: #374151; font-weight: 500; border-bottom: 1px solid #f3f4f6; }
    .feedback-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 10px 15px; border-radius: 0 8px 8px 0; font-size: 0.85rem; font-style: italic; color: #92400e; }
</style>
@endpush

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="total-score-box">
            <div class="score-circle">{{ number_format($persentasePuas, 0) }}%</div>
            <h5 class="fw-bold mb-1">Tingkat Kepuasan</h5>
            <p class="text-muted mb-0 small">Berdasarkan akumulasi data masuk</p>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="panel-container h-100 mb-0">
            <h5 class="fw-bold mb-4 border-bottom pb-3">Ringkasan Data Responden</h5>
            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary"><i class="bi bi-people-fill"></i></div>
                        <div><div class="text-muted small fw-bold mb-1">Total Responden</div><h4 class="mb-0 fw-bold">{{ $totalSurveys }}</h4></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-emoji-smile-fill"></i></div>
                        <div><div class="text-muted small fw-bold mb-1">Total Puas</div><h4 class="mb-0 fw-bold text-success">{{ $totalPuas }}</h4></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-danger bg-opacity-10 text-danger"><i class="bi bi-emoji-frown-fill"></i></div>
                        <div><div class="text-muted small fw-bold mb-1">Tidak Puas</div><h4 class="mb-0 fw-bold text-danger">{{ $totalTidakPuas }}</h4></div>
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
                    <th width="25%">Tingkat Kepuasan</th>
                    <th width="55%">Kritik & Saran</th>
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
                        @if($survey->kepuasan == 'Puas')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill"><i class="bi bi-emoji-smile-fill me-1"></i> Puas</span>
                        @elseif($survey->kepuasan == 'Tidak Puas')
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-pill"><i class="bi bi-emoji-frown-fill me-1"></i> Tidak Puas</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
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