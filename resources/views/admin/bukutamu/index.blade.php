@extends('layouts.admin')
@section('title', 'Data Buku Tamu - Admin')
@section('page_title', 'Data Buku Tamu')

@push('styles')
<style>
    .panel-container { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
    .table-modern th { background: #f9fafb; color: #6b7280; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; padding: 15px; }
    .table-modern td { padding: 15px; vertical-align: middle; color: #374151; font-weight: 500; border-bottom: 1px solid #f3f4f6; }
    /* Menghapus margin-right manual karena akan digantikan oleh gap-1 dari Flexbox */
    .btn-action { border-radius: 8px; padding: 5px 10px; font-size: 0.85rem; }
</style>
@endpush

@section('content')
<div class="panel-container">
    <div class="row mb-4 align-items-center">
        <div class="col-lg-6 mb-3 mb-lg-0">
            <form action="{{ route('admin.bukutamu.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau instansi..." value="{{ request('search') }}">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-dark"><i class="bi bi-search"></i></button>
                @if(request()->has('search') || request()->has('start_date'))
                    <a href="{{ route('admin.bukutamu.index') }}" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i></a>
                @endif
            </form>
        </div>
        <div class="col-lg-6 text-lg-end">
            <a href="{{ route('admin.bukutamu.pdf') }}" class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
            <a href="{{ route('admin.bukutamu.excel') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-modern table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama & Instansi</th>
                    <th>Kontak</th>
                    <th>Tujuan</th>
                    <th>Waktu Kedatangan</th>
                    <!-- Lebar kolom aksi disesuaikan agar pas menampung 3 tombol -->
                    <th class="text-center" style="white-space: nowrap; width: 150px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guests as $index => $guest)
                <tr>
                    <td>{{ $guests->firstItem() + $index }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $guest->nama }}</div>
                        <div class="text-muted small">{{ $guest->instansi }}</div>
                    </td>
                    <td>
                        <div><i class="bi bi-telephone-fill text-muted me-1"></i> {{ $guest->no_hp }}</div>
                        @if($guest->email)
                        <div class="small"><i class="bi bi-envelope-fill text-muted me-1"></i> {{ $guest->email }}</div>
                        @endif
                    </td>
                    <td>{{ Str::limit($guest->tujuan, 30) }}</td>
                    <td>
                        <div class="fw-bold">{{ $guest->created_at->format('d M Y') }}</div>
                        <div class="text-muted small">{{ $guest->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td>
                        <!-- Kotak ajaib flex-nowrap agar tombol selalu berbaris rapi -->
                        <div class="d-flex justify-content-center flex-nowrap gap-1">
                            <a href="{{ route('admin.bukutamu.show', $guest->id) }}" class="btn btn-info btn-action text-white" title="Lihat Detail & TTD"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.bukutamu.edit', $guest->id) }}" class="btn btn-warning btn-action text-white" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            
                            <!-- Class d-inline dihapus dan diganti margin-padding 0 agar sejajar -->
                            <form action="{{ route('admin.bukutamu.destroy', $guest->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted">Data tamu tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4 d-flex justify-content-end">
        {{ $guests->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection