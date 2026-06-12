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
        .left-banner { background: linear-gradient(135deg, #4ade80 0%, #0284c7 100%); border-radius: 20px; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .brand-wrapper { display: flex; align-items: center; gap: 20px; }
        .animated-logo { max-width: 100px; height: auto; display: block; }
        .brand-text { font-size: 2.3rem; color: white; line-height: 1.1; letter-spacing: 1px; }
        .right-form { background: #ffffff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); }
        .form-control, .form-select { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 15px; }
        .form-control:focus, .form-select:focus { border-color: #4ade80; box-shadow: 0 0 0 0.25rem rgba(74, 222, 128, 0.25); }
        #sig-canvas { border: 2px dashed #0b5b9e; border-radius: 12px; cursor: crosshair; width: 100%; height: 250px; background-color: #f8fafc; touch-action: none; transition: all 0.3s ease; }
        .btn-check:checked + .btn-outline-success { background-color: #198754; color: white; border-color: #198754; }
        .btn-check:checked + .btn-outline-danger { background-color: #dc3545; color: white; border-color: #dc3545; }
        .btn-submit { background: linear-gradient(90deg, #1cb5e0 0%, #000851 100%); color: white; }
        .btn-submit:hover { color: white; opacity: 0.9; }
        .custom-footer { background-color: #1a1e21; color: #d1d5db; font-size: 0.9rem; padding: 20px 0; border-top: 3px solid #4ade80; }
        .footer-ptsp { color: #4ade80; font-weight: 600; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="top-header py-3">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo" width="55" class="me-3">
                <div><h4 class="mb-0 text-kemenag fs-5 fs-md-4">Kanwil Kemenag Provinsi Jambi</h4><span class="text-muted small">Buku Tamu Digital</span></div>
            </div>
            <div class="d-flex align-items-center mt-2 mt-md-0 d-none d-lg-block">
                <div class="text-end"><small class="text-muted fw-bold d-block mb-1" id="currentDate"></small><div class="clock-box px-3 py-1 fs-6 d-inline-block" id="digitalClock"><i class="bi bi-clock"></i> 00:00:00</div></div>
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
                                <p class="fs-6 mb-5" style="line-height: 1.8; opacity: 0.9; color: white;">Kami senang menyambut Anda. Silakan isi data diri Anda pada formulir di samping untuk keperluan registrasi dan penilaian layanan kami.</p>
                            </div>
                            <div class="mt-auto border-top pt-4" style="border-color: rgba(255, 255, 255, 0.3) !important;">
                                <div class="brand-wrapper">
                                    <img src="{{ asset('images/kemenag-berdampak.png') }}" class="animated-logo">
                                    <div class="brand-text"><span style="font-weight: 900;">IKHLAS</span><br><span style="font-weight: 400;">BERAMAL</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="right-form p-4 p-md-5 h-100">
                        <h3 class="mb-4 fw-bold text-kemenag border-bottom pb-3">Registrasi Kunjungan Tamu</h3>
                        
                        @if(session('success')) <div class="alert alert-success fw-bold"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div> @endif
                        @if ($errors->any()) <div class="alert alert-danger shadow-sm"><ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div> @endif

                        <form action="{{ route('guest.store') }}" method="POST" id="guestForm">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-person-fill me-1"></i> Nama Lengkap Tamu <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-building me-1"></i> Asal Instansi/Perusahaan/Personal <span class="text-danger">*</span></label>
                                    <input type="text" name="instansi" class="form-control" placeholder="Contoh: Dirjen/Kemenag RI/Dinkes" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-telephone-fill me-1"></i> Nomor Telepon/WA <span class="text-danger">*</span></label>
                                    <input type="number" name="no_hp" class="form-control" placeholder="Contoh: 085380987263" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-envelope-fill me-1"></i> Alamat Email <span class="text-secondary fw-normal">(Optional)</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Contoh: nama@example.com">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold"><i class="bi bi-list-check me-1"></i> Keperluan Kunjungan <span class="text-danger">*</span></label>
                                <select name="tujuan" id="tujuanSelect" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Keperluan Kunjungan Anda --</option>
                                    <option value="IZIN BELAJAR BAGI PNS KEMENAG">IZIN BELAJAR BAGI PNS KEMENAG</option>
                                    <option value="TUGAS BELAJAR BAGI PNS">TUGAS BELAJAR BAGI PNS</option>
                                    <option value="IZIN PENELITIAN DI MADRASAH">IZIN PENELITIAN DI MADRASAH</option>
                                    <option value="KONSULTASI WAKAF">KONSULTASI WAKAF</option>
                                    <option value="LAYANAN IZIN OPERASIONAL PENDIDIKAN TAKLIMUL QURAN LIL AULAD">LAYANAN IZIN OPERASIONAL PENDIDIKAN TAKLIMUL QURAN LIL AULAD</option>
                                    <option value="LAYANAN BANTUAN MASJID/MUSHALLA">LAYANAN BANTUAN MASJID/MUSHALLA</option>
                                    <option value="LAYANAN DATA DAN INFORMASI">LAYANAN DATA DAN INFORMASI</option>
                                    <option value="LAYANAN FASILITASI KONSULTASI PELESTARIAN PERKAWINAN">LAYANAN FASILITASI KONSULTASI PELESTARIAN PERKAWINAN</option>
                                    <option value="LAYANAN IZIN OPERASIONAL MADRASAH DINIYAH TINGKAT ULYA">LAYANAN IZIN OPERASIONAL MADRASAH DINIYAH TINGKAT ULYA</option>
                                    <option value="LAYANAN IZIN OPERASIONAL PROGRAM ULYA WAJAR DIKDAS">LAYANAN IZIN OPERASIONAL PROGRAM ULYA WAJAR DIKDAS</option>
                                    <option value="LAYANAN KONSULTASI SYARI'AH DAN PAHAM ALIRAN KEAGAMAAN">LAYANAN KONSULTASI SYARI'AH DAN PAHAM ALIRAN KEAGAMAAN</option>
                                    <option value="LAYANAN LEGALISASI BUKU NIKAH / SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS ISLAM">LAYANAN LEGALISASI BUKU NIKAH / SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS ISLAM</option>
                                    <option value="LAYANAN PENGADUAN MASYARAKAT">LAYANAN PENGADUAN MASYARAKAT</option>
                                    <option value="LAYANAN PENGAJUAN IZIN OPERASIONAL PENDIRIAN PONDOK PESANTREN">LAYANAN PENGAJUAN IZIN OPERASIONAL PENDIRIAN PONDOK PESANTREN</option>
                                    <option value="LAYANAN PENGAJUAN PROPOSAL BANTUAN PONDOK PESANTREN/MADRASAH DINIYAH TAKMILIYAH/PENDIDIKAN AL-QURAN">LAYANAN PENGAJUAN PROPOSAL BANTUAN PONDOK PESANTREN/MADRASAH DINIYAH TAKMILIYAH/PENDIDIKAN AL-QURAN</option>
                                    <option value="LAYANAN PENGUKURAN ARAH KIBLAT MASJID/MUSHALLA">LAYANAN PENGUKURAN ARAH KIBLAT MASJID/MUSHALLA</option>
                                    <option value="LAYANAN UPLOAD INFORMASI PENTING">LAYANAN UPLOAD INFORMASI PENTING</option>
                                    <option value="LEGALISASI BUKU NIKAH/SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS KATOLIK">LEGALISASI BUKU NIKAH/SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS KATOLIK</option>
                                    <option value="LEGALISASI IJAZAH PADA BIMAS KATOLIK">LEGALISASI IJAZAH PADA BIMAS KATOLIK</option>
                                    <option value="LEGALISIR DOKUMEN IJAZAH MADRASAH">LEGALISIR DOKUMEN IJAZAH MADRASAH</option>
                                    <option value="LEGALISIR DOKUMEN KEPEGAWAIAN">LEGALISIR DOKUMEN KEPEGAWAIAN</option>
                                    <option value="LEGALISIR DOKUMEN PIAGAM">LEGALISIR DOKUMEN PIAGAM</option>
                                    <option value="LEGALISIR IJAZAH PONDOK PESANTREN SALAFIYAH (PPS)">LEGALISIR IJAZAH PONDOK PESANTREN SALAFIYAH (PPS)</option>
                                    <option value="PENGAJUAN IZIN MAGANG PADA KANWIL">PENGAJUAN IZIN MAGANG PADA KANWIL</option>
                                    <option value="PERMOHONAN AUDIENSI DENGAN KA. KANWIL">PERMOHONAN AUDIENSI DENGAN KA. KANWIL</option>
                                    <option value="PERMOHONAN LEGALISASI LEMBAGA AMIL ZAKAT">PERMOHONAN LEGALISASI LEMBAGA AMIL ZAKAT</option>
                                    <option value="PERMOHONAN PENCERAMAH AGAMA">PERMOHONAN PENCERAMAH AGAMA</option>
                                    <option value="PERMOHONAN ROHANIAWAN">PERMOHONAN ROHANIAWAN</option>
                                    <option value="PERMOHONAN SEBAGAI NARA SUMBER PADA BIMAS KATOLIK">PERMOHONAN SEBAGAI NARA SUMBER PADA BIMAS KATOLIK</option>
                                    <option value="REKOMENDASI IZIN BELAJAR AGAMA BAGI WNA">REKOMENDASI IZIN BELAJAR AGAMA BAGI WNA</option>
                                    <option value="REKOMENDASI IZIN TINGGAL TERBATAS (ITAS) BAGI WNA">REKOMENDASI IZIN TINGGAL TERBATAS (ITAS) BAGI WNA</option>
                                    <option value="REKOMENDASI KEGIATAN KEAGAMAAN">REKOMENDASI KEGIATAN KEAGAMAAN</option>
                                    <option value="REKOMENDASI PASPOR PENDIDIKAN DAN KEAGAMAAN">REKOMENDASI PASPOR PENDIDIKAN DAN KEAGAMAAN</option>
                                    <option value="REKOMENDASI PINDAH SEKOLAH">REKOMENDASI PINDAH SEKOLAH</option>
                                    <option value="REKOMENDASI RPTKA (RENCANA PENGGUNAAN TENAGA KERJA ASING) DAN IMTA BAGI WNA">REKOMENDASI RPTKA (RENCANA PENGGUNAAN TENAGA KERJA ASING) DAN IMTA BAGI WNA</option>
                                    <option value="SERTIFIKASI HALAL">SERTIFIKASI HALAL</option>
                                    <option value="SURAT KETERANGAN PENGGANTIAN IJAZAH">SURAT KETERANGAN PENGGANTIAN IJAZAH</option>
                                    <option value="TATA PERSURATAN (SURAT KELUAR)">TATA PERSURATAN (SURAT KELUAR)</option>
                                    <option value="TATA PERSURATAN (SURAT MASUK)">TATA PERSURATAN (SURAT MASUK)</option>
                                    <option value="Keperluan lainnya">Keperluan lainnya...</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold" id="label-catatan"><i class="bi bi-journal-text me-1"></i> Catatan Tambahan <span class="text-secondary fw-normal">(Optional)</span></label>
                                <textarea name="catatan" id="catatanInput" class="form-control" rows="2" placeholder="Informasi tambahan atau rincian layanan jika diperlukan"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold d-block"><i class="bi bi-pen-fill me-1"></i> Tanda Tangan <span class="text-danger">*</span></label>
                                <div class="signature-wrapper">
                                    <canvas id="sig-canvas" class="shadow-sm"></canvas>
                                    <textarea name="ttd" id="sig-dataUrl" style="display:none;"></textarea>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button type="button" class="btn btn-sm btn-outline-secondary fw-bold rounded-pill px-4 py-2" id="sig-undoBtn"><i class="bi bi-arrow-counterclockwise me-1"></i> Undo</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-4 py-2" id="sig-clearBtn"><i class="bi bi-eraser-fill me-1"></i> Hapus Semua</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5 mt-4 p-4 rounded-4" style="background-color: #f8fafc; border: 1px dashed #cbd5e1;">
                                <label class="form-label text-dark fw-bold fs-5 text-center d-block mb-3"><i class="bi bi-star-fill text-warning me-2"></i> Apakah Anda puas terhadap layanan kami? <span class="text-danger">*</span></label>
                                <div class="row g-3 text-center">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="kepuasan" id="puas" value="Puas" required>
                                        <label class="btn btn-outline-success w-100 py-3 fw-bold rounded-4" for="puas"><i class="bi bi-emoji-smile-fill fs-2 d-block mb-1"></i> PUAS</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="kepuasan" id="tidak_puas" value="Tidak Puas" required>
                                        <label class="btn btn-outline-danger w-100 py-3 fw-bold rounded-4" for="tidak_puas"><i class="bi bi-emoji-frown-fill fs-2 d-block mb-1"></i> TIDAK PUAS</label>
                                    </div>
                                </div>
                                <div class="mt-4 border-top pt-3">
                                    <label class="form-label text-dark fw-bold"><i class="bi bi-chat-left-text-fill me-1 text-primary"></i> Kritik dan Saran <span class="text-secondary fw-normal">(Optional)</span></label>
                                    <textarea name="saran" class="form-control" rows="2" placeholder="Tuliskan kritik, masukan, atau saran Anda di sini..."></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit w-100 py-3 fw-bold fs-5 rounded-4" id="submitBtn">
                                <i class="bi bi-send-check-fill me-2"></i> KIRIM REGISTRASI & PENILAIAN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // LOGIKA DROPDOWN DINAMIS
        document.getElementById('tujuanSelect').addEventListener('change', function() {
            let catLabel = document.getElementById('label-catatan');
            let catInput = document.getElementById('catatanInput');
            if(this.value === 'Keperluan lainnya') {
                catLabel.innerHTML = '<i class="bi bi-journal-text me-1"></i> Sebutkan Keperluan Anda <span class="text-danger">*</span>';
                catInput.required = true;
                catInput.placeholder = "Ketik keperluan spesifik Anda di sini...";
                catInput.focus();
            } else {
                catLabel.innerHTML = '<i class="bi bi-journal-text me-1"></i> Catatan Tambahan <span class="text-secondary fw-normal">(Optional)</span>';
                catInput.required = false;
                catInput.placeholder = "Informasi tambahan atau rincian layanan jika diperlukan";
            }
        });

        // SCRIPT JAM
        function updateClock() { const now = new Date(); const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; document.getElementById('currentDate').innerText = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`; document.getElementById('digitalClock').innerHTML = `<i class="bi bi-clock me-1"></i> ${now.toLocaleTimeString('id-ID', { hour12: false })}`; } setInterval(updateClock, 1000); updateClock();

        // SCRIPT CANVAS TANDA TANGAN
        (function() {
            var canvas = document.getElementById("sig-canvas"); var ctx = canvas.getContext("2d"); var drawing = false; var strokeHistory = [];
            function saveState() { strokeHistory.push(canvas.toDataURL()); }
            function resizeCanvas() { var rect = canvas.getBoundingClientRect(); canvas.width = rect.width; canvas.height = rect.height; ctx.lineWidth = 3; ctx.lineCap = "round"; ctx.strokeStyle = "#000000"; }
            window.addEventListener("resize", resizeCanvas); resizeCanvas(); saveState(); 
            function getPos(e) { var rect = canvas.getBoundingClientRect(); var clientX = e.clientX || (e.touches && e.touches[0].clientX); var clientY = e.clientY || (e.touches && e.touches[0].clientY); return { x: clientX - rect.left, y: clientY - rect.top }; }
            function startPos(e) { e.preventDefault(); drawing = true; var pos = getPos(e); ctx.beginPath(); ctx.moveTo(pos.x, pos.y); draw(e); }
            function endPos(e) { e.preventDefault(); if(drawing) { drawing = false; ctx.beginPath(); saveState(); } }
            function draw(e) { e.preventDefault(); if (!drawing) return; var pos = getPos(e); ctx.lineTo(pos.x, pos.y); ctx.stroke(); ctx.beginPath(); ctx.moveTo(pos.x, pos.y); }
            canvas.addEventListener("mousedown", startPos); canvas.addEventListener("mouseup", endPos); canvas.addEventListener("mousemove", draw);
            canvas.addEventListener("touchstart", startPos, { passive: false }); canvas.addEventListener("touchend", endPos, { passive: false }); canvas.addEventListener("touchmove", draw, { passive: false });
            document.getElementById("sig-undoBtn").addEventListener("click", function() { if (strokeHistory.length > 1) { strokeHistory.pop(); var prevImg = new Image(); prevImg.src = strokeHistory[strokeHistory.length - 1]; prevImg.onload = function() { ctx.clearRect(0, 0, canvas.width, canvas.height); ctx.drawImage(prevImg, 0, 0); }; } });
            document.getElementById("sig-clearBtn").addEventListener("click", function() { ctx.clearRect(0, 0, canvas.width, canvas.height); document.getElementById("sig-dataUrl").value = ""; strokeHistory = []; saveState(); });
            document.getElementById("guestForm").addEventListener("submit", function() { document.getElementById("sig-dataUrl").value = canvas.toDataURL(); });
        })();
    </script>
</body>
</html>