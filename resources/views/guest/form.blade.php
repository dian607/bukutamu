<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Kanwil Kemenag Provinsi Jambi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        .top-header { background-color: #ffffff; box-shadow: 0 4px 20px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
        .text-kemenag { color: #0b5b9e; font-weight: 800; }
        .clock-box { background-color: #eef2f9; color: #0b5b9e; border-radius: 8px; font-weight: bold; }
        
        /* Tombol Top Right */
        .btn-top-action {
            background: linear-gradient(90deg, #58d68d, #2874a6); color: white; border: none; box-shadow: 0 4px 10px rgba(40, 116, 166, 0.3); transition: all 0.3s ease;
        }
        .btn-top-action:hover { transform: scale(1.05) translateY(-2px); color: white; box-shadow: 0 6px 15px rgba(40, 116, 166, 0.4); }

        .left-banner { background: linear-gradient(135deg, #4ade80 0%, #0284c7 100%); border-radius: 20px; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        
        /* ANIMASI LOGO & TEKS */
        @keyframes smoothFloat { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(1.5deg); } }
        .brand-wrapper { display: flex; align-items: center; gap: 20px; animation: smoothFloat 4s ease-in-out infinite; }
        .animated-logo { max-width: 100px; height: auto; display: block; }
        .brand-text { font-size: 2.3rem; color: white; line-height: 1.1; letter-spacing: 1px; }

        /* ANIMASI TRANSISI HALAMAN */
        @keyframes pageTransition { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
        .right-form { background: #ffffff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); animation: pageTransition 0.6s cubic-bezier(0.23, 1, 0.32, 1) both; }
        
        .form-control { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 15px; }
        .form-control:focus { border-color: #4ade80; box-shadow: 0 0 0 0.25rem rgba(74, 222, 128, 0.25); }
        
        /* CANVAS TANDA TANGAN DENGAN KURSOR HITAM */
        #sig-canvas { 
            border: 2px dashed #0b5b9e; 
            border-radius: 10px; 
            /* Menggunakan kursor custom berbentuk '+' tebal berwarna hitam */
            cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><line x1="10" y1="0" x2="10" y2="20" stroke="black" stroke-width="2"/><line x1="0" y1="10" x2="20" y2="10" stroke="black" stroke-width="2"/></svg>') 10 10, crosshair; 
            width: 100%; 
            background-color: #f8fafc; 
        }
        
        .btn-submit { background: linear-gradient(90deg, #1cb5e0 0%, #000851 100%); color: white; transition: all 0.3s; }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0, 8, 81, 0.3); color: white; }
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
                <a href="{{ route('guest.indeks') }}" class="btn btn-top-action rounded-pill px-4 py-2 fw-bold text-decoration-none d-flex align-items-center">
                    <i class="bi bi-star-fill text-warning me-2"></i> Indeks Kepuasan
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
                        <h3 class="mb-4 fw-bold text-kemenag border-bottom pb-3">Registrasi Kunjungan Tamu</h3>
                        
                        @if(session('success')) <div class="alert alert-success fw-bold"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div> @endif
                        
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('guest.store') }}" method="POST" id="guestForm">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-person-fill me-1"></i> Nama Lengkap Tamu <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-building me-1"></i> Asal Instansi/Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" name="instansi" class="form-control" placeholder="Contoh: Dinkes/Umum/Pribadi" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-telephone-fill me-1"></i> Nomor Telepon/WA <span class="text-danger">*</span></label>
                                    <input type="number" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-envelope-fill me-1"></i> Alamat Email <span class="text-secondary fw-normal">(Optional)</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Contoh: nama@example.com">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold"><i class="bi bi-chat-square-text-fill me-1"></i> Keperluan Kunjungan <span class="text-danger">*</span></label>
                                <textarea name="tujuan" class="form-control" rows="2" placeholder="Jelaskan tujuan kunjungan Anda" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold"><i class="bi bi-journal-text me-1"></i> Catatan Tambahan <span class="text-secondary fw-normal">(Optional)</span></label>
                                <textarea name="catatan" class="form-control" rows="2" placeholder="Informasi tambahan jika ada"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold d-block"><i class="bi bi-pen-fill me-1"></i> Tanda Tangan <span class="text-danger">*</span></label>
                                <div class="d-inline-block w-100" style="max-width: 400px;">
                                    <canvas id="sig-canvas" height="150" class="shadow-sm"></canvas>
                                    <textarea name="ttd" id="sig-dataUrl" style="display:none;"></textarea>
                                    <div class="text-end mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3" id="sig-clearBtn">
                                            <i class="bi bi-eraser-fill"></i> Hapus Tanda Tangan
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit w-100 py-3 fw-bold fs-5 rounded-4 mt-2" id="submitBtn">
                                <i class="bi bi-send-check-fill me-2"></i> KIRIM REGISTRASI
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="custom-footer mt-auto text-center"><div class="container"><p class="mb-0">&copy; 2026 Kanwil Kemenag Provinsi Jambi. Dirancang dengan <i class="bi bi-suit-heart-fill text-danger"></i> untuk pelayanan prima. Powered by <span class="footer-ptsp">Tim PTSP Kanwil Kemenag Provinsi Jambi</span></p></div></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // SCRIPT JAM
        function updateClock() {
            const now = new Date(); const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            document.getElementById('currentDate').innerText = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            document.getElementById('digitalClock').innerHTML = `<i class="bi bi-clock me-1"></i> ${now.toLocaleTimeString('id-ID', { hour12: false })}`;
        } setInterval(updateClock, 1000); updateClock();

        // SCRIPT CANVAS
        (function(){ var canvas=document.getElementById("sig-canvas"),ctx=canvas.getContext("2d"),drawing=!1;function resizeCanvas(){var a=Math.max(window.devicePixelRatio||1,1);canvas.width=canvas.offsetWidth*a,canvas.height=canvas.offsetHeight*a,ctx.scale(a,a)}window.onresize=resizeCanvas,resizeCanvas();function getPos(a){var b=canvas.getBoundingClientRect();return{x:(a.clientX||a.touches&&a.touches[0].clientX)-b.left,y:(a.clientY||a.touches&&a.touches[0].clientY)-b.top}}function startPos(a){a.preventDefault(),drawing=!0,draw(a)}function endPos(a){a.preventDefault(),drawing=!1,ctx.beginPath()}function draw(a){if(a.preventDefault(),!drawing)return;var b=getPos(a);ctx.lineWidth=3,ctx.lineCap="round",ctx.strokeStyle="#000000",ctx.lineTo(b.x,b.y),ctx.stroke(),ctx.beginPath(),ctx.moveTo(b.x,b.y)}canvas.addEventListener("mousedown",startPos),canvas.addEventListener("mouseup",endPos),canvas.addEventListener("mousemove",draw),canvas.addEventListener("touchstart",startPos,{passive:!1}),canvas.addEventListener("touchend",endPos,{passive:!1}),canvas.addEventListener("touchmove",draw,{passive:!1}),document.getElementById("sig-clearBtn").addEventListener("click",function(){ctx.clearRect(0,0,canvas.width/(window.devicePixelRatio||1),canvas.height/(window.devicePixelRatio||1))}),document.getElementById("guestForm").addEventListener("submit",function(){document.getElementById("sig-dataUrl").value=canvas.toDataURL()})})();
    </script>
</body>
</html>