<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DatareservasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reservasi = Reservasi::orderBy('tanggal_reservasi', 'asc')
            ->where(function ($query) use ($search) {
                $query->where('nama_depan', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama_belakang', 'LIKE', '%' . $search . '%');
            })
            ->get();
        
            foreach ($reservasi as $reservation) {
                $reservation->nama_belakang = Str::limit($reservation->nama_belakang, ceil(Str::length($reservation->nama_belakang) / 2), '***');
            }


        return view('datareservasi.index', compact('reservasi'));
    }
}
