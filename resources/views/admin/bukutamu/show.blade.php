@extends('layouts.admin')
@section('title', 'Detail Tamu - Admin')
@section('page_title', 'Detail Data Tamu')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    .detail-label { font-weight: 600; color: #6b7280; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
    .detail-value { font-weight: 600; color: #111827; font-size: 1.1rem; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f3f4f6; }
    .ttd-box { border: 2px dashed #cbd5e1; border-radius: 15px; padding: 15px; text-align: center; background: #f8fafc; }
    .ttd-img { max-width: 100%; height: auto; max-height: 150px; filter: contrast(1.2); }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="panel-container">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-0"><i class="bi bi-person-badge-fill text-success me-2"></i> Informasi Lengkap Kunjungan</h5>
                <a href="{{ route('admin.bukutamu.index') }}" class="btn btn-light rounded-pill px-3 fw-bold"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-label">Nama Lengkap</div>
                    <div class="detail-value">{{ $guest->nama }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Asal Instansi/Perusahaan</div>
                    <div class="detail-value">{{ $guest->instansi }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Nomor HP/WA</div>
                    <div class="detail-value">{{ $guest->no_hp }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Alamat Email</div>
                    <div class="detail-value">{{ $guest->email ?? '-' }}</div>
                </div>
                <div class="col-12">
                    <div class="detail-label">Waktu Kedatangan</div>
                    <div class="detail-value text-success">{{ $guest->created_at->format('l, d F Y - H:i') }} WIB</div>
                </div>
                <div class="col-12">
                    <div class="detail-label">Tujuan Kunjungan</div>
                    <div class="detail-value">{{ $guest->tujuan }}</div>
                </div>
                <div class="col-12">
                    <div class="detail-label">Catatan Tambahan</div>
                    <div class="detail-value">{{ $guest->catatan ?? 'Tidak ada catatan' }}</div>
                </div>
                <div class="col-12 mt-3">
                    <div class="detail-label mb-3">Tanda Tangan Pengunjung</div>
                    <div class="ttd-box">
                        @if($guest->ttd)
                            <img src="{{ $guest->ttd }}" alt="Tanda Tangan" class="ttd-img">
                        @else
                            <span class="text-muted">Tidak ada tanda tangan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection