<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan - Kanwil Kemenag Provinsi Jambi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        .top-header { background-color: #ffffff; box-shadow: 0 4px 20px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
        .text-kemenag { color: #0b5b9e; font-weight: 800; }
        .clock-box { background-color: #eef2f9; color: #0b5b9e; border-radius: 8px; font-weight: bold; }
        
        /* Tombol Top Right */
        .btn-top-action { background: #ffffff; color: #0b5b9e; border: 2px solid #0b5b9e; transition: all 0.3s ease; }
        .btn-top-action:hover { background: #0b5b9e; color: white; transform: scale(1.05); }

        .left-banner { background: linear-gradient(135deg, #4ade80 0%, #0284c7 100%); border-radius: 20px; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        
        /* ANIMASI LOGO & TEKS */
        @keyframes smoothFloat { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(1.5deg); } }
        .brand-wrapper { display: flex; align-items: center; gap: 20px; animation: smoothFloat 4s ease-in-out infinite; }
        .animated-logo { max-width: 100px; height: auto; display: block; }
        .brand-text { font-size: 2.3rem; color: white; line-height: 1.1; letter-spacing: 1px; }

        /* ANIMASI TRANSISI HALAMAN MODERN (Masuk dari Kiri) */
        @keyframes pageTransition {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .right-form { background: #ffffff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); animation: pageTransition 0.6s cubic-bezier(0.23, 1, 0.32, 1) both; }
        
        .form-control { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 15px; }
        .form-control:focus { border-color: #4ade80; box-shadow: 0 0 0 0.25rem rgba(74, 222, 128, 0.25); }
        
        /* Form Box Survei */
        .survey-box { border: 1px solid #e2e8f0; border-radius: 10px; padding: 15px 20px; margin-bottom: 15px; background-color: #ffffff; transition: 0.3s; }
        .survey-box:hover { border-color: #4ade80; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .form-check-input:checked { background-color: #0b5b9e; border-color: #0b5b9e; }
        .form-check-label { cursor: pointer; margin-left: 5px; font-weight: 500; }
        
        .btn-submit { background: linear-gradient(90deg, #1cb5e0 0%, #4ade80 100%); color: white; transition: all 0.3s; }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(28, 181, 224, 0.3); color: white; }
        .custom-footer { background-color: #1a1e21; color: #d1d5db; font-size: 0.9rem; padding: 20px 0; border-top: 3px solid #4ade80; }
        .footer-ptsp { color: #4ade80; font-weight: 600; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="top-header py-3">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo" width="55" class="me-3">
                <div>
                    <h4 class="mb-0 text-kemenag fs-5 fs-md-4">Kanwil Kemenag Provinsi Jambi</h4>
                    <span class="text-muted small">Buku Tamu Digital</span>
                </div>
            </div>
            <div class="d-flex align-items-center mt-2 mt-md-0">
                <div class="me-4 text-end d-none d-lg-block">
                    <small class="text-muted fw-bold d-block mb-1" id="currentDate"></small>
                    <div class="clock-box px-3 py-1 fs-6 d-inline-block" id="digitalClock"><i class="bi bi-clock"></i> 00:00:00</div>
                </div>
                <a href="{{ route('guest.form') }}" class="btn btn-top-action rounded-pill px-4 py-2 fw-bold text-decoration-none d-flex align-items-center">
                    <i class="bi bi-person-plus-fill me-2"></i> Register Tamu
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4">
                    <div class="left-banner p-4 p-md-5 d-flex flex-column h-100">
                        <div class="banner-content flex-grow-1 d-flex flex-column">
                            <div>
                                <span class="badge bg-light text-success mb-4 px-3 py-2 fs-6 rounded-pill">Selamat Datang!</span>
                                <h1 class="fw-bold mb-4" style="font-size: 2.5rem; color: white;">Buku Tamu Digital</h1>
                                <p class="fs-6 mb-5" style="line-height: 1.8; opacity: 0.9; color: white;">
                                    Kami senang menyambut Anda. Silakan isi data diri Anda pada formulir di samping untuk keperluan dokumentasi dan pelayanan yang lebih baik.
                                </p>
                            </div>
                            <div class="mt-auto border-top pt-4" style="border-color: rgba(255, 255, 255, 0.3) !important;">
                                <div class="brand-wrapper">
                                    <img src="{{ asset('images/kemenag-berdampak.png') }}" class="animated-logo">
                                    <div class="brand-text">
                                        <span style="font-weight: 900;">IKHLAS</span><br>
                                        <span style="font-weight: 400;">BERAMAL</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="right-form p-4 p-md-5 h-100">
                        <h3 class="mb-4 fw-bold text-kemenag border-bottom pb-3">Formulir Indeks Kepuasan Layanan</h3>
                        
                        @if(session('success')) 
                            <div class="alert alert-success fw-bold"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div> 
                        @endif

                        <form action="{{ route('guest.storeIndeks') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label text-muted fw-bold"><i class="bi bi-person-fill me-1"></i> Nama Anda <span class="text-secondary fw-normal">(Opsional)</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Boleh dikosongkan jika ingin anonim">
                            </div>

                            <p class="fw-bold text-dark mb-3">Berikan penilaian Anda (1 = Sangat Buruk, 5 = Sangat Baik):</p>

                            <div class="survey-box">
                                <label class="fw-bold d-block mb-2 text-dark"><i class="bi bi-headset"></i> Kualitas Pelayanan:</label>
                                <div class="d-flex flex-wrap gap-4 px-2">
                                    @for($i=1; $i<=5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kualitas" id="q1_{{$i}}" value="{{$i}}" required>
                                        <label class="form-check-label" for="q1_{{$i}}">{{$i}}</label>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="survey-box">
                                <label class="fw-bold d-block mb-2 text-dark"><i class="bi bi-building"></i> Fasilitas yang Tersedia:</label>
                                <div class="d-flex flex-wrap gap-4 px-2">
                                    @for($i=1; $i<=5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fasilitas" id="q2_{{$i}}" value="{{$i}}" required>
                                        <label class="form-check-label" for="q2_{{$i}}">{{$i}}</label>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="survey-box">
                                <label class="fw-bold d-block mb-2 text-dark"><i class="bi bi-emoji-smile"></i> Keramahan Staf:</label>
                                <div class="d-flex flex-wrap gap-4 px-2">
                                    @for($i=1; $i<=5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="keramahan" id="q3_{{$i}}" value="{{$i}}" required>
                                        <label class="form-check-label" for="q3_{{$i}}">{{$i}}</label>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="survey-box">
                                <label class="fw-bold d-block mb-2 text-dark"><i class="bi bi-clock-history"></i> Kecepatan Layanan:</label>
                                <div class="d-flex flex-wrap gap-4 px-2">
                                    @for($i=1; $i<=5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kecepatan" id="q4_{{$i}}" value="{{$i}}" required>
                                        <label class="form-check-label" for="q4_{{$i}}">{{$i}}</label>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="mb-4 mt-4">
                                <label class="form-label text-muted fw-bold"><i class="bi bi-chat-right-text-fill me-1"></i> Saran dan Masukan <span class="text-secondary fw-normal">(Opsional)</span></label>
                                <textarea name="saran" class="form-control" rows="3" placeholder="Sampaikan saran atau masukan Anda untuk perbaikan layanan kami"></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit w-100 py-3 fw-bold fs-5 rounded-4 mt-2">
                                <i class="bi bi-send-fill me-2"></i> KIRIM SURVEI
                            </button>
                            
                            <div class="text-center mt-4">
                                <a href="{{ route('guest.form') }}" class="text-decoration-none fw-bold" style="color: #0b5b9e;">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Registrasi Tamu
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="custom-footer mt-auto text-center"><div class="container"><p class="mb-0">&copy; 2026 Kanwil Kemenag Provinsi Jambi. Dirancang dengan <i class="bi bi-suit-heart-fill text-danger"></i> untuk pelayanan prima. Powered by <span class="footer-ptsp">Tim PTSP Kanwil Kemenag Provinsi Jambi</span></p></div></footer>

    <script>
        function updateClock() {
            const now = new Date(); const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            document.getElementById('currentDate').innerText = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            document.getElementById('digitalClock').innerHTML = `<i class="bi bi-clock me-1"></i> ${now.toLocaleTimeString('id-ID', { hour12: false })}`;
        } setInterval(updateClock, 1000); updateClock();
    </script>
</body>
</html>