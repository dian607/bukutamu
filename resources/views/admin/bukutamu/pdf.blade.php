<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku Tamu</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; margin: 0; padding: 20px; }
        .kop-surat { width: 100%; border-bottom: 4px solid black; padding-bottom: 5px; margin-bottom: 2px; position: relative; }
        .kop-surat-2 { width: 100%; border-bottom: 1px solid black; margin-bottom: 20px; }
        .logo { position: absolute; left: 0; top: 0; width: 80px; }
        .text-kop { text-align: center; margin-left: 80px; margin-right: 80px; }
        .text-kop h3 { margin: 0; font-size: 16px; font-weight: bold; }
        .text-kop h4 { margin: 0; font-size: 18px; font-weight: bold; }
        .text-kop p { margin: 0; font-size: 11px; line-height: 1.3; }
        .title { text-align: center; margin-bottom: 20px; font-size: 14px; font-weight: bold; text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    
    <div class="kop-surat">
        <img src="{{ public_path('logo-kemenag.png') }}" class="logo" alt="Logo Kemenag">
        <div class="text-kop">
            <h3>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h3>
            <h4>KANTOR WILAYAH KEMENTERIAN AGAMA<br>PROVINSI JAMBI</h4>
            <p>Jalan Jend. A. Yani No. 13 Telanaipura Jambi 36122<br>Telepon (0741) 62800 - 62803 Faksimili (0741) 62802<br>Website: jambi.kemenag.go.id</p>
        </div>
    </div>
    <div class="kop-surat-2"></div>

    <div class="title">
        LAPORAN DATA BUKU TAMU
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">NO</th>
                <th width="13%">HARI / TANGGAL</th>
                <th width="17%">NAMA</th>
                <th width="15%">ASAL INSTANSI</th>
                <th width="14%">NOMOR HP / WHATSAPP</th>
                <th width="22%">TUJUAN</th>
                <th width="15%">TANDA TANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $index => $g)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($g->created_at)->translatedFormat('d M Y') }}</td>
                <td>{{ $g->nama }}</td>
                <td>{{ $g->instansi }}</td>
                <td class="text-center">{{ $g->no_hp }}</td> <td>{{ $g->tujuan }}</td>
                <td class="text-center">
                    @if(!empty($g->ttd))
                        <img src="{{ $g->ttd }}" alt="TTD" style="max-height: 40px; max-width: 60px;">
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>