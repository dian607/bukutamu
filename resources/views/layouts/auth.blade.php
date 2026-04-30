<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autentikasi - Kemenag Jambi')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f7f6; /* Warna abu-abu soft */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER MODERN */
        .auth-header {
            background-color: transparent;
            padding: 20px 0;
            position: absolute;
            width: 100%;
            top: 0;
            z-index: 10;
        }
        .header-brand {
            color: #2e7d32;
            font-weight: 800;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .nav-link-custom {
            color: #4b5563;
            font-weight: 600;
            margin-left: 15px;
            text-decoration: none;
            transition: color 0.3s;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            color: #2e7d32;
        }

        /* KARTU AUTENTIKASI (SPLIT SCREEN) */
        .auth-wrapper {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 20px 40px 20px;
        }
        .auth-card {
            background: #ffffff;
            border-radius: 30px; /* Radius besar modern */
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 900px;
            min-height: 550px;
            display: flex;
            overflow: hidden;
            position: relative;
        }

        /* BAGIAN FORM (KIRI/KANAN) */
        .auth-form-side {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }
        .auth-form-side h2 {
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            background-color: #f3f4f6;
            border: none;
            border-radius: 10px;
            padding: 14px 20px;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            background-color: #ffffff;
            border: 2px solid #66bb6a;
            box-shadow: none;
        }
        .btn-primary-custom {
            background-color: #2e7d32;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            background-color: #1b5e20;
            transform: translateY(-2px);
        }

        /* BAGIAN PANEL GRADASI (KIRI/KANAN) */
        .auth-panel-side {
            flex: 1;
            /* Gradasi Hijau Kemenag */
            background: linear-gradient(135deg, #66bb6a 0%, #2e7d32 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        /* Efek Lengkungan (Curved) seperti di referensi */
        .panel-right {
            border-top-left-radius: 150px;
            border-bottom-left-radius: 20px;
        }
        .panel-left {
            border-top-right-radius: 150px;
            border-bottom-right-radius: 20px;
        }
        
        .auth-panel-side h1 {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .auth-panel-side p {
            font-size: 1rem;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        .btn-outline-custom {
            border: 2px solid #ffffff;
            color: #ffffff;
            background: transparent;
            border-radius: 30px;
            padding: 10px 40px;
            font-weight: bold;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-outline-custom:hover {
            background: #ffffff;
            color: #2e7d32;
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                min-height: auto;
            }
            .auth-panel-side {
                border-radius: 0 !important;
                padding: 40px 20px;
            }
            .auth-form-side {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

    <header class="auth-header">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="header-brand d-flex align-items-center">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo" width="40" class="me-2">
                <span class="d-none d-sm-inline">Kanwil Kemenag Provinsi Jambi</span>
            </a>
            
            <div>
                <a href="{{ route('login') }}" class="nav-link-custom {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link-custom {{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
                @endif
            </div>
        </div>
    </header>

    <div class="auth-wrapper">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>