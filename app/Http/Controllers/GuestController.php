<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    // === FITUR BUKU TAMU TERINTEGRASI ===
    public function create()
    {
        return view('guest.form'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'instansi' => 'required',
            'no_hp'    => 'required|numeric',
            'email'    => 'nullable|email',
            'tujuan'   => 'required',
            'catatan'  => 'nullable',
            'ttd'      => 'required',
            'kepuasan' => 'required|in:Puas,Tidak Puas', // Validasi kepuasan
        ], [
            'no_hp.numeric' => 'Nomor HP/WA hanya boleh berisi angka.',
            'email.email'   => 'Format alamat email tidak valid.'
        ]);

        Guest::create([
            'nama'     => $request->nama,
            'instansi' => $request->instansi,
            'no_hp'    => $request->no_hp,
            'email'    => $request->email,
            'tujuan'   => $request->tujuan,
            'catatan'  => $request->catatan,
            'ttd'      => $request->ttd,
            'kepuasan' => $request->kepuasan, // Menyimpan kepuasan
        ]);

        return redirect()->back()->with('success', 'Data berhasil dikirim! Terima kasih atas kunjungan dan penilaian Anda.');
    }
}