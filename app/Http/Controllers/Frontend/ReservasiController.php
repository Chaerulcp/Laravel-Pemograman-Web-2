<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

class ReservasiController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservasi = $request->session()->get('reservasi');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservasi.step-one', compact('reservasi', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => ['required'],
            'nama_belakang' => ['required'],
            'email' => ['required', 'email'],
            'tanggal_reservasi' => ['required', new DateBetween, new TimeBetween],
            'no_hp' => ['required'],
            'kapasitas' => ['required'],
        ]);
    
        // Convert the input date and time to a Carbon instance
        $validated['tanggal_reservasi'] = Carbon::parse($validated['tanggal_reservasi']);

    
        $reservasi = new Reservasi($validated);
        $request->session()->put('reservasi', $reservasi);
    
        return redirect()->route('reservasi.step.two');
    }
    

    public function stepTwo(Request $request)
    {
        $reservasi = $request->session()->get('reservasi');
        $tanggal_reservasi_ids = Reservasi::orderBy('tanggal_reservasi')->get()->filter(function ($value) use ($reservasi) {
            return ($value instanceof DateTime && $reservasi instanceof DateTime) && $value->format('Y-m-d') == $reservasi->format('Y-m-d');

        })->pluck('table_id');
        
        $tables = Table::where('status', TableStatus::Tersedia)
            ->where('kapasitas', '>=', $reservasi->kapasitas)
            ->whereNotIn('id', $tanggal_reservasi_ids)
            ->get();

        return view('reservasi.step-two', compact('reservasi', 'tables'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);

        $reservasi = $request->session()->get('reservasi');
        
        if ($reservasi !== null) {
            $reservasi->fill($validated);
            $reservasi->save();
            $request->session()->forget('reservasi');
        } else {
            // Lakukan tindakan yang sesuai jika $reservasi bernilai null
        }

        return redirect()->route('terima-kasih');

    }
}
