<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class BukuTamuExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $rowNumber = 0;

    public function collection()
    {
        return Guest::select('id', 'created_at', 'nama', 'instansi', 'no_hp', 'tujuan')->get();
    }

    public function map($guest): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            Carbon::parse($guest->created_at)->translatedFormat('d/m/Y'),
            $guest->nama,
            $guest->instansi,
            $guest->no_hp,
            $guest->tujuan,
        ];
    }

    public function headings(): array
    {
        return [
            ['KEMENTERIAN AGAMA REPUBLIK INDONESIA'],
            ['KANTOR WILAYAH KEMENTERIAN AGAMA PROVINSI JAMBI'],
            ['Jalan Jend. A. Yani No. 13 Telanaipura Jambi 36122'],
            ['Telepon (0741) 62800 - 62803 Faksimili (0741) 62802'],
            [''],
            ['LAPORAN DATA BUKU TAMU'],
            [''],
            // Header No HP diubah menjadi lebih spesifik sesuai revisi instansi
            ["No", "Tanggal", "Nama Tamu", "Instansi", "Nomor HP / WhatsApp", "Tujuan"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');
        $sheet->mergeCells('A3:F3');
        $sheet->mergeCells('A4:F4');
        $sheet->mergeCells('A6:F6');

        $sheet->getStyle('A1:A6')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(12);
        
        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
        $sheet->getStyle('A8:F8')->getAlignment()->setHorizontal('center');
    }
}