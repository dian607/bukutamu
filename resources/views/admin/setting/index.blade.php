@extends('layouts.admin')
@section('title', 'Pengaturan Akun - Admin')
@section('page_title', 'Pengaturan Akun')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    .form-control { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 15px; }
    .form-control:focus { border-color: #4ade80; box-shadow: none; background-color: #ffffff; }
    .user-badge { width: 80px; height: 80px; background: linear-gradient(135deg, #66bb6a, #2e7d32); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 800; margin-bottom: 15px; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="panel-container">
            <div class="row align-items-center mb-4 pb-4 border-bottom">
                <div class="col-md-auto text-center">
                    <div class="user-badge mx-auto">{{ substr($user->name, 0, 1) }}</div>
                </div>
                <div class="col-md">
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-0">Administrator Sistem Buku Tamu Kanwil Kemenag Jambi</p>
                </div>
            </div>

            <form action="{{ route('admin.setting.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold text-success mb-3"><i class="bi bi-person-fill"></i> Data Profil</h6>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold text-success mb-3"><i class="bi bi-shield-lock-fill"></i> Keamanan (Ganti Password)</h6>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <div class="text-end pt-3 border-top mt-2">
                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-check2-circle me-1"></i> SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection