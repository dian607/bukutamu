@extends('layouts.admin')
@section('title', 'Edit Tamu - Admin')
@section('page_title', 'Edit Data Tamu')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    .form-control, .form-select { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 15px; }
    .form-control:focus, .form-select:focus { border-color: #4ade80; box-shadow: none; background-color: #ffffff; }
    .form-label { font-weight: 600; color: #4b5563; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="panel-container">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning me-2"></i> Perbarui Data Kunjungan</h5>
                <a href="{{ route('admin.bukutamu.index') }}" class="btn btn-light rounded-pill px-3 fw-bold"><i class="bi bi-arrow-left me-1"></i> Batal</a>
            </div>

            <form action="{{ route('admin.bukutamu.update', $guest->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ $guest->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asal Instansi <span class="text-danger">*</span></label>
                        <input type="text" name="instansi" class="form-control" value="{{ $guest->instansi }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP/WA <span class="text-danger">*</span></label>
                        <input type="number" name="no_hp" class="form-control" value="{{ $guest->no_hp }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $guest->email }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Tujuan Kunjungan <span class="text-danger">*</span></label>
                        <select name="tujuan" class="form-select" required>
                            <option value="IZIN BELAJAR BAGI PNS KEMENAG" {{ $guest->tujuan == 'IZIN BELAJAR BAGI PNS KEMENAG' ? 'selected' : '' }}>IZIN BELAJAR BAGI PNS KEMENAG</option>
                            <option value="TUGAS BELAJAR BAGI PNS" {{ $guest->tujuan == 'TUGAS BELAJAR BAGI PNS' ? 'selected' : '' }}>TUGAS BELAJAR BAGI PNS</option>
                            <option value="IZIN PENELITIAN DI MADRASAH" {{ $guest->tujuan == 'IZIN PENELITIAN DI MADRASAH' ? 'selected' : '' }}>IZIN PENELITIAN DI MADRASAH</option>
                            <option value="KONSULTASI WAKAF" {{ $guest->tujuan == 'KONSULTASI WAKAF' ? 'selected' : '' }}>KONSULTASI WAKAF</option>
                            <option value="LAYANAN IZIN OPERASIONAL PENDIDIKAN TAKLIMUL QURAN LIL AULAD" {{ $guest->tujuan == 'LAYANAN IZIN OPERASIONAL PENDIDIKAN TAKLIMUL QURAN LIL AULAD' ? 'selected' : '' }}>LAYANAN IZIN OPERASIONAL PENDIDIKAN TAKLIMUL QURAN LIL AULAD</option>
                            <option value="LAYANAN BANTUAN MASJID/MUSHALLA" {{ $guest->tujuan == 'LAYANAN BANTUAN MASJID/MUSHALLA' ? 'selected' : '' }}>LAYANAN BANTUAN MASJID/MUSHALLA</option>
                            <option value="LAYANAN DATA DAN INFORMASI" {{ $guest->tujuan == 'LAYANAN DATA DAN INFORMASI' ? 'selected' : '' }}>LAYANAN DATA DAN INFORMASI</option>
                            <option value="LAYANAN FASILITASI KONSULTASI PELESTARIAN PERKAWINAN" {{ $guest->tujuan == 'LAYANAN FASILITASI KONSULTASI PELESTARIAN PERKAWINAN' ? 'selected' : '' }}>LAYANAN FASILITASI KONSULTASI PELESTARIAN PERKAWINAN</option>
                            <option value="LAYANAN IZIN OPERASIONAL MADRASAH DINIYAH TINGKAT ULYA" {{ $guest->tujuan == 'LAYANAN IZIN OPERASIONAL MADRASAH DINIYAH TINGKAT ULYA' ? 'selected' : '' }}>LAYANAN IZIN OPERASIONAL MADRASAH DINIYAH TINGKAT ULYA</option>
                            <option value="LAYANAN IZIN OPERASIONAL PROGRAM ULYA WAJAR DIKDAS" {{ $guest->tujuan == 'LAYANAN IZIN OPERASIONAL PROGRAM ULYA WAJAR DIKDAS' ? 'selected' : '' }}>LAYANAN IZIN OPERASIONAL PROGRAM ULYA WAJAR DIKDAS</option>
                            <option value="LAYANAN KONSULTASI SYARI'AH DAN PAHAM ALIRAN KEAGAMAAN" {{ $guest->tujuan == "LAYANAN KONSULTASI SYARI'AH DAN PAHAM ALIRAN KEAGAMAAN" ? 'selected' : '' }}>LAYANAN KONSULTASI SYARI'AH DAN PAHAM ALIRAN KEAGAMAAN</option>
                            <option value="LAYANAN LEGALISASI BUKU NIKAH / SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS ISLAM" {{ $guest->tujuan == 'LAYANAN LEGALISASI BUKU NIKAH / SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS ISLAM' ? 'selected' : '' }}>LAYANAN LEGALISASI BUKU NIKAH / SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS ISLAM</option>
                            <option value="LAYANAN PENGADUAN MASYARAKAT" {{ $guest->tujuan == 'LAYANAN PENGADUAN MASYARAKAT' ? 'selected' : '' }}>LAYANAN PENGADUAN MASYARAKAT</option>
                            <option value="LAYANAN PENGAJUAN IZIN OPERASIONAL PENDIRIAN PONDOK PESANTREN" {{ $guest->tujuan == 'LAYANAN PENGAJUAN IZIN OPERASIONAL PENDIRIAN PONDOK PESANTREN' ? 'selected' : '' }}>LAYANAN PENGAJUAN IZIN OPERASIONAL PENDIRIAN PONDOK PESANTREN</option>
                            <option value="LAYANAN PENGAJUAN PROPOSAL BANTUAN PONDOK PESANTREN/MADRASAH DINIYAH TAKMILIYAH/PENDIDIKAN AL-QURAN" {{ $guest->tujuan == 'LAYANAN PENGAJUAN PROPOSAL BANTUAN PONDOK PESANTREN/MADRASAH DINIYAH TAKMILIYAH/PENDIDIKAN AL-QURAN' ? 'selected' : '' }}>LAYANAN PENGAJUAN PROPOSAL BANTUAN PONDOK PESANTREN/MADRASAH DINIYAH TAKMILIYAH/PENDIDIKAN AL-QURAN</option>
                            <option value="LAYANAN PENGUKURAN ARAH KIBLAT MASJID/MUSHALLA" {{ $guest->tujuan == 'LAYANAN PENGUKURAN ARAH KIBLAT MASJID/MUSHALLA' ? 'selected' : '' }}>LAYANAN PENGUKURAN ARAH KIBLAT MASJID/MUSHALLA</option>
                            <option value="LAYANAN UPLOAD INFORMASI PENTING" {{ $guest->tujuan == 'LAYANAN UPLOAD INFORMASI PENTING' ? 'selected' : '' }}>LAYANAN UPLOAD INFORMASI PENTING</option>
                            <option value="LEGALISASI BUKU NIKAH/SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS KATOLIK" {{ $guest->tujuan == 'LEGALISASI BUKU NIKAH/SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS KATOLIK' ? 'selected' : '' }}>LEGALISASI BUKU NIKAH/SURAT KETERANGAN STATUS PERNIKAHAN PADA BIMAS KATOLIK</option>
                            <option value="LEGALISASI IJAZAH PADA BIMAS KATOLIK" {{ $guest->tujuan == 'LEGALISASI IJAZAH PADA BIMAS KATOLIK' ? 'selected' : '' }}>LEGALISASI IJAZAH PADA BIMAS KATOLIK</option>
                            <option value="LEGALISIR DOKUMEN IJAZAH MADRASAH" {{ $guest->tujuan == 'LEGALISIR DOKUMEN IJAZAH MADRASAH' ? 'selected' : '' }}>LEGALISIR DOKUMEN IJAZAH MADRASAH</option>
                            <option value="LEGALISIR DOKUMEN KEPEGAWAIAN" {{ $guest->tujuan == 'LEGALISIR DOKUMEN KEPEGAWAIAN' ? 'selected' : '' }}>LEGALISIR DOKUMEN KEPEGAWAIAN</option>
                            <option value="LEGALISIR DOKUMEN PIAGAM" {{ $guest->tujuan == 'LEGALISIR DOKUMEN PIAGAM' ? 'selected' : '' }}>LEGALISIR DOKUMEN PIAGAM</option>
                            <option value="LEGALISIR IJAZAH PONDOK PESANTREN SALAFIYAH (PPS)" {{ $guest->tujuan == 'LEGALISIR IJAZAH PONDOK PESANTREN SALAFIYAH (PPS)' ? 'selected' : '' }}>LEGALISIR IJAZAH PONDOK PESANTREN SALAFIYAH (PPS)</option>
                            <option value="PENGAJUAN IZIN MAGANG PADA KANWIL" {{ $guest->tujuan == 'PENGAJUAN IZIN MAGANG PADA KANWIL' ? 'selected' : '' }}>PENGAJUAN IZIN MAGANG PADA KANWIL</option>
                            <option value="PERMOHONAN AUDIENSI DENGAN KA. KANWIL" {{ $guest->tujuan == 'PERMOHONAN AUDIENSI DENGAN KA. KANWIL' ? 'selected' : '' }}>PERMOHONAN AUDIENSI DENGAN KA. KANWIL</option>
                            <option value="PERMOHONAN LEGALISASI LEMBAGA AMIL ZAKAT" {{ $guest->tujuan == 'PERMOHONAN LEGALISASI LEMBAGA AMIL ZAKAT' ? 'selected' : '' }}>PERMOHONAN LEGALISASI LEMBAGA AMIL ZAKAT</option>
                            <option value="PERMOHONAN PENCERAMAH AGAMA" {{ $guest->tujuan == 'PERMOHONAN PENCERAMAH AGAMA' ? 'selected' : '' }}>PERMOHONAN PENCERAMAH AGAMA</option>
                            <option value="PERMOHONAN ROHANIAWAN" {{ $guest->tujuan == 'PERMOHONAN ROHANIAWAN' ? 'selected' : '' }}>PERMOHONAN ROHANIAWAN</option>
                            <option value="PERMOHONAN SEBAGAI NARA SUMBER PADA BIMAS KATOLIK" {{ $guest->tujuan == 'PERMOHONAN SEBAGAI NARA SUMBER PADA BIMAS KATOLIK' ? 'selected' : '' }}>PERMOHONAN SEBAGAI NARA SUMBER PADA BIMAS KATOLIK</option>
                            <option value="REKOMENDASI IZIN BELAJAR AGAMA BAGI WNA" {{ $guest->tujuan == 'REKOMENDASI IZIN BELAJAR AGAMA BAGI WNA' ? 'selected' : '' }}>REKOMENDASI IZIN BELAJAR AGAMA BAGI WNA</option>
                            <option value="REKOMENDASI IZIN TINGGAL TERBATAS (ITAS) BAGI WNA" {{ $guest->tujuan == 'REKOMENDASI IZIN TINGGAL TERBATAS (ITAS) BAGI WNA' ? 'selected' : '' }}>REKOMENDASI IZIN TINGGAL TERBATAS (ITAS) BAGI WNA</option>
                            <option value="REKOMENDASI KEGIATAN KEAGAMAAN" {{ $guest->tujuan == 'REKOMENDASI KEGIATAN KEAGAMAAN' ? 'selected' : '' }}>REKOMENDASI KEGIATAN KEAGAMAAN</option>
                            <option value="REKOMENDASI PASPOR PENDIDIKAN DAN KEAGAMAAN" {{ $guest->tujuan == 'REKOMENDASI PASPOR PENDIDIKAN DAN KEAGAMAAN' ? 'selected' : '' }}>REKOMENDASI PASPOR PENDIDIKAN DAN KEAGAMAAN</option>
                            <option value="REKOMENDASI PINDAH SEKOLAH" {{ $guest->tujuan == 'REKOMENDASI PINDAH SEKOLAH' ? 'selected' : '' }}>REKOMENDASI PINDAH SEKOLAH</option>
                            <option value="REKOMENDASI RPTKA (RENCANA PENGGUNAAN TENAGA KERJA ASING) DAN IMTA BAGI WNA" {{ $guest->tujuan == 'REKOMENDASI RPTKA (RENCANA PENGGUNAAN TENAGA KERJA ASING) DAN IMTA BAGI WNA' ? 'selected' : '' }}>REKOMENDASI RPTKA (RENCANA PENGGUNAAN TENAGA KERJA ASING) DAN IMTA BAGI WNA</option>
                            <option value="SERTIFIKASI HALAL" {{ $guest->tujuan == 'SERTIFIKASI HALAL' ? 'selected' : '' }}>SERTIFIKASI HALAL</option>
                            <option value="SURAT KETERANGAN PENGGANTIAN IJAZAH" {{ $guest->tujuan == 'SURAT KETERANGAN PENGGANTIAN IJAZAH' ? 'selected' : '' }}>SURAT KETERANGAN PENGGANTIAN IJAZAH</option>
                            <option value="TATA PERSURATAN (SURAT KELUAR)" {{ $guest->tujuan == 'TATA PERSURATAN (SURAT KELUAR)' ? 'selected' : '' }}>TATA PERSURATAN (SURAT KELUAR)</option>
                            <option value="TATA PERSURATAN (SURAT MASUK)" {{ $guest->tujuan == 'TATA PERSURATAN (SURAT MASUK)' ? 'selected' : '' }}>TATA PERSURATAN (SURAT MASUK)</option>
                            <option value="Keperluan lainnya" {{ $guest->tujuan == 'Keperluan lainnya' ? 'selected' : '' }}>Keperluan lainnya...</option>
                        </select>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label">Catatan Tambahan Asli <span class="text-muted fw-normal">(Detail Keperluan)</span></label>
                        <textarea name="catatan" class="form-control" rows="2">{{ $guest->catatan }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-3">SIMPAN PERUBAHAN DATA</button>
            </form>
        </div>
    </div>
</div>
@endsection