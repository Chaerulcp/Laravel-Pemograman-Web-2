<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservasiStoreRequest;
use App\Models\Reservasi;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;


class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = Reservasi::all();
        return view('admin.reservasi.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $table = Table::where('status', TableStatus::Tersedia)->get();
        return view('admin.reservasi.create', compact('table'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservasiStoreRequest $request)
    {
        $table = Table::findOrFail($request->table_id);
        if ($request->kapasitas > $table->kapasitas) {
            return back()->with('warning', 'Kapasitas meja tidak mencukupi.');
        }
        $request_date = Carbon::parse($request->tanggal_reservasi);
        foreach ($table->reservasi as $res) {
            $reservasi_date = Carbon::parse($res->tanggal_reservasi);
            if ($reservasi_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'Meja sudah dipesan pada tanggal tersebut.');
            }
        }
        Reservasi::create($request->validated());

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservasi $reservasi)
    {
        $table = Table::where('status', TableStatus::Tersedia)->get();
        return view('admin.reservasi.edit', compact('reservasi', 'table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservasiStoreRequest $request, Reservasi $reservasi)
    {
        $table = Table::findOrFail($request->table_id);
        if ($request->kapasitas > $table->kapasitas) {
            return back()->with('warning', 'Kapasitas meja tidak mencukupi.');
        }
        $request_date = Carbon::parse($request->tanggal_reservasi);
        $existingReservasi = $table->reservasi()->where('id', '!=', $reservasi->id)->get();
        foreach ($existingReservasi as $res) {
            $reservasi_date = Carbon::parse($res->tanggal_reservasi);
            if ($reservasi_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'Meja sudah dipesan pada tanggal tersebut.');
            }
        }

        $reservasi->update($request->validated());
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();

        return redirect()->route('admin.reservasi.index')->with('danger', 'Reservasi berhasil dihapus.');
    }
}