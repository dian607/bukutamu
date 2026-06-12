<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;

class BukuTamuController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian & Filter Tanggal
        $query = Guest::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('instansi', 'like', '%' . $request->search . '%');
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Urutkan dari yang terbaru dan beri paginasi
        $guests = $query->latest()->paginate(10);

        return view('admin.bukutamu.index', compact('guests'));
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return view('admin.bukutamu.show', compact('guest'));
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('admin.bukutamu.edit', compact('guest'));
    }

  public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'instansi' => 'required',
            'no_hp' => 'required',
            'tujuan' => 'required',
        ]);

        $guest->update([
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'tujuan' => $request->tujuan, 
            'catatan' => $request->catatan, 
        ]);

        return redirect()->route('admin.bukutamu.index')->with('success', 'Data tamu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();
        
        return redirect()->route('admin.bukutamu.index')->with('success', 'Data tamu berhasil dihapus!');
    }

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BukuTamuExport, 'Laporan_Buku_Tamu.xlsx');
    }

    public function exportPdf()
    {
        $guests = Guest::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.bukutamu.pdf', compact('guests'));
        return $pdf->download('Laporan_Buku_Tamu.pdf');
    }
}