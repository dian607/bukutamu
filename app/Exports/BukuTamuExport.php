<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuTamuExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Guest::select('id', 'created_at', 'nama', 'instansi', 'no_hp', 'tujuan')->get();
    }

    public function headings(): array
    {
        return ["ID", "Tanggal Kunjungan", "Nama Tamu", "Instansi", "No HP", "Tujuan"];
    }
}