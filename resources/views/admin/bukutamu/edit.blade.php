@extends('layouts.admin')
@section('title', 'Edit Tamu - Admin')
@section('page_title', 'Edit Data Tamu')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    .form-control { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 15px; }
    .form-control:focus { border-color: #4ade80; box-shadow: none; background-color: #ffffff; }
    .form-label { font-weight: 600; color: #4b5563; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="panel-container">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning me-2"></i> Perbarui Data Kunjungan</h5>
                <a href="{{ route('admin.bukutamu.index') }}" class="btn btn-light rounded-pill px-3 fw-bold"><i class="bi bi-arrow-left me-1"></i> Batal</a>
            </div>

            <form action="{{ route('admin.bukutamu.update', $guest->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ $guest->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asal Instansi <span class="text-danger">*</span></label>
                        <input type="text" name="instansi" class="form-control" value="{{ $guest->instansi }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP/WA <span class="text-danger">*</span></label>
                        <input type="number" name="no_hp" class="form-control" value="{{ $guest->no_hp }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $guest->email }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Tujuan Kunjungan <span class="text-danger">*</span></label>
                        <textarea name="tujuan" class="form-control" rows="3" required>{{ $guest->tujuan }}</textarea>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label">Catatan Tambahan <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="catatan" class="form-control" rows="2">{{ $guest->catatan }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-3">SIMPAN PERUBAHAN DATA</button>
            </form>
        </div>
    </div>
</div>
@endsection