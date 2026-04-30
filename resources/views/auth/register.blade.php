@extends('layouts.auth')
@section('title', 'Register Admin - Kemenag Jambi')

@section('content')
<div class="auth-card flex-row-reverse">
    
    <div class="auth-form-side">
        <h2>Register</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Lengkap">
            @error('name')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Alamat Email">
            @error('email')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback mb-3 d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password-confirm" type="password" class="form-control mb-4" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">

            <button type="submit" class="btn btn-primary-custom w-100 text-white">
                REGISTER
            </button>
        </form>
    </div>

    <div class="auth-panel-side panel-left d-none d-md-flex">
        <h1>Selamat Datang!</h1>
        <p>Untuk tetap terhubung dengan kami, silakan login menggunakan informasi akun pribadi Anda yang telah terdaftar.</p>
        <a href="{{ route('login') }}" class="btn-outline-custom">LOGIN</a>
    </div>

</div>
@endsection