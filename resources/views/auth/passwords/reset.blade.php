@extends('layouts.auth')
@section('title', 'Buat Password Baru - Kemenag Jambi')

@section('content')
<div class="auth-card">
    
    <div class="auth-form-side">
        <h2>Buat Password Baru</h2>
        <p class="text-muted mb-4 text-center" style="font-size: 0.9rem;">
            Silakan masukkan password baru untuk akun Anda.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Alamat Email" readonly>
            
            @error('email')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mt-3" name="password" required autocomplete="new-password" autofocus placeholder="Password Baru">
            
            @error('password')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password-confirm" type="password" class="form-control mb-4" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password Baru">

            <button type="submit" class="btn btn-primary-custom w-100 text-white mt-2">
                SIMPAN PASSWORD BARU
            </button>
        </form>
    </div>

    <div class="auth-panel-side panel-right d-none d-md-flex">
        <h1>Langkah Terakhir!</h1>
        <p>Buatlah password yang kuat dan mudah Anda ingat. Setelah ini, Anda bisa kembali login dan menggunakan sistem seperti biasa.</p>
    </div>

</div>
@endsection