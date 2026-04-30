@extends('layouts.auth')
@section('title', 'Login Admin - Kemenag Jambi')

@section('content')
<div class="auth-card">
    
    <div class="auth-form-side">
        <h2>Login</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Alamat Email">
            @error('email')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="text-center mb-4 mt-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted small">
                        Lupa Password Anda?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 text-white">
                LOGIN
            </button>
        </form>
    </div>

    <div class="auth-panel-side panel-right d-none d-md-flex">
        <h1>Selamat Datang</h1>
        <p>Daftarkan data diri Anda beserta kredensial pribadi untuk menggunakan seluruh fitur manajemen pada sistem ini.</p>
        <a href="{{ route('register') }}" class="btn-outline-custom">REGISTER</a>
    </div>

</div>
@endsection