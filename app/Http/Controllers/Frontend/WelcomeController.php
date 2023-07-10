<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials = Kategori::where('nama', 'Specials')->first();

        return view('welcome', compact('specials'));
    }
}
