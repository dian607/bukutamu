<h2 style="text-align: center;">LAPORAN DATA BUKU TAMU</h2>
<h3 style="text-align: center;">Kanwil Kemenag Provinsi Jambi</h3>
<hr>
<table border="1" width="100%" cellpadding="8" cellspacing="0">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Tamu</th>
            <th>Instansi</th>
            <th>Tujuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guests as $index => $g)
        <tr>
            <td style="text-align: center;">{{ $index + 1 }}</td>
            <td>{{ $g->created_at->format('d/m/Y') }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->instansi }}</td>
            <td>{{ $g->tujuan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>