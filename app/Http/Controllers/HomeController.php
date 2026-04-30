<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guests = Guest::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('guests'));
    }

    public function destroy($id)
    {
        Guest::find($id)->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus');
    }
}