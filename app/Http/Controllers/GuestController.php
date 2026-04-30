<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Survey; // <-- Pastikan ini ada untuk memanggil tabel survei

class GuestController extends Controller
{
    // === FITUR BUKU TAMU ===
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
        ]);

        return redirect()->back()->with('success', 'Data berhasil dikirim! Terima kasih atas kunjungan Anda.');
    }

    // === FITUR INDEKS KEPUASAN (BARU) ===
    public function indeks()
    {
        return view('guest.indeks'); // Menampilkan halaman survei
    }

    public function storeIndeks(Request $request)
    {
        // Validasi isian survei (angka 1-5 wajib diisi)
        $request->validate([
            'kualitas'  => 'required|integer',
            'fasilitas' => 'required|integer',
            'keramahan' => 'required|integer',
            'kecepatan' => 'required|integer',
        ]);

        // Simpan ke database
        Survey::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih atas penilaian dan masukan Anda!');
    }
}