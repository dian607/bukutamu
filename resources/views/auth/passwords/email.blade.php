@extends('layouts.auth')
@section('title', 'Lupa Password - Kemenag Jambi')

@section('content')
<div class="auth-card">
    
    <div class="auth-form-side">
        <h2>Lupa Password?</h2>
        <p class="text-muted mb-4 text-center" style="font-size: 0.9rem;">
            Masukkan email Anda yang terdaftar. Kami akan mengirimkan tautan pemulihan ke email tersebut.
        </p>
        
        @if (session('status'))
            <div class="alert alert-success fw-bold text-center" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Alamat Email Anda">
            
            @error('email')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary-custom w-100 text-white mt-2">
                KIRIM LINK PEMULIHAN
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none text-muted small fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke halaman Login
                </a>
            </div>
        </form>
    </div>

    <div class="auth-panel-side panel-right d-none d-md-flex">
        <h1>Jangan Panik!</h1>
        <p>Kehilangan akses adalah hal biasa. Masukkan email Anda, dan kami akan membantu Anda kembali masuk ke dalam sistem dengan aman.</p>
    </div>

</div>
@endsection