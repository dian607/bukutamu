<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kemenag')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; overflow-x: hidden; }
        
        /* SIDEBAR MODERN */
        #sidebar {
            min-width: 260px; max-width: 260px; background: #ffffff; color: #4b5563;
            transition: all 0.3s; position: fixed; height: 100vh; z-index: 999;
            box-shadow: 2px 0 15px rgba(0,0,0,0.03); border-right: 1px solid #e5e7eb;
        }
        .sidebar-header { padding: 25px 20px; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; }
        .sidebar-header h4 { font-weight: 800; color: #2e7d32; font-size: 1.2rem; margin: 0; }
        
        .sidebar-menu { padding: 20px 0; list-style: none; margin: 0; }
        .sidebar-menu li { padding: 5px 20px; margin-bottom: 5px; }
        .sidebar-menu a {
            display: flex; align-items: center; color: #6b7280; padding: 12px 15px;
            text-decoration: none; border-radius: 12px; font-weight: 500; transition: all 0.3s;
        }
        .sidebar-menu a i { font-size: 1.2rem; margin-right: 15px; transition: all 0.3s; }
        
        /* Hover & Active State (Hijau Kemenag) */
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: linear-gradient(135deg, #66bb6a 0%, #2e7d32 100%);
            color: #ffffff; box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3); transform: translateX(5px);
        }
        .sidebar-menu a:hover i, .sidebar-menu a.active i { color: #ffffff; }

        /* KONTEN UTAMA */
        #content { margin-left: 260px; width: calc(100% - 260px); min-height: 100vh; transition: all 0.3s; }
        
        /* NAVBAR UTAMA */
        .top-navbar {
            background: #ffffff; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex; justify-content: space-between; align-items: center;
        }
        .profile-btn { background: #f3f4f6; border-radius: 30px; padding: 5px 15px 5px 5px; font-weight: 600; color: #374151; border: none; }
        .profile-avatar { width: 35px; height: 35px; border-radius: 50%; background: #2e7d32; color: white; display: inline-flex; justify-content: center; align-items: center; margin-right: 10px; font-weight: bold; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            #sidebar { margin-left: -260px; }
            #sidebar.active { margin-left: 0; }
            #content { margin-left: 0; width: 100%; }
            #content.active { margin-left: 260px; width: calc(100% - 260px); }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo-kemenag.png') }}" width="35" class="me-2" alt="Logo">
                <h4>Kanwil Kemenag</h4>
            </div>
            <ul class="sidebar-menu">
                <li class="text-xs fw-bold text-uppercase text-muted mb-2 px-3 mt-2" style="font-size: 0.75rem;">Main Menu</li>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-fill"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.bukutamu.index') }}" class="{{ request()->routeIs('admin.bukutamu.*') ? 'active' : '' }}"><i class="bi bi-book-fill"></i> Data Buku Tamu</a></li>
                <li><a href="{{ route('admin.survei.index') }}" class="{{ request()->routeIs('admin.survei.*') ? 'active' : '' }}"><i class="bi bi-star-fill"></i> Indeks Kepuasan</a></li>
                
                <li class="text-xs fw-bold text-uppercase text-muted mb-2 px-3 mt-4" style="font-size: 0.75rem;">Sistem</li>
                <li><a href="{{ route('admin.setting.index') }}" class="{{ request()->routeIs('admin.setting.*') ? 'active' : '' }}"><i class="bi bi-gear-fill"></i> Pengaturan</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                        <i class="bi bi-box-arrow-right text-danger"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </nav>

        <div id="content">
            <div class="top-navbar">
                <button class="btn btn-light d-md-none" id="sidebarCollapse"><i class="bi bi-list fs-4"></i></button>
                <h5 class="mb-0 fw-bold text-dark d-none d-md-block">@yield('page_title', 'Dashboard')</h5>
                
                <div class="dropdown">
                    <button class="profile-btn d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <div class="profile-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        {{ Auth::user()->name }} <i class="bi bi-chevron-down ms-2 fs-6"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 12px;">
                        <li><a class="dropdown-item py-2" href="{{ route('admin.setting.index') }}"><i class="bi bi-person-circle me-2"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="p-4 p-md-5">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Toggle Sidebar Mobile
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });

        // SweetAlert Notifikasi
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        @endif
    </script>
    @stack('scripts')
</body>
</html>