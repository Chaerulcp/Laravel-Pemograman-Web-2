<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\DatareservasiController;
use App\Http\Controllers\Frontend\KategoriController as FrontendKategoriController;
use App\Http\Controllers\Frontend\ReservasiController as FrontendReservasiController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/kategori', [FrontendKategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{kategori}', [FrontendKategoriController::class, 'show'])->name('kategori.show');
Route::get('/menu', [FrontendMenuController::class, 'index'])->name('menu.index');
Route::get('/reservasi/step-one', [FrontendReservasiController::class, 'stepOne'])->name('reservasi.step.one');
Route::post('/reservasi/step-one', [FrontendReservasiController::class, 'storeStepOne'])->name('reservasi.store.step.one');
Route::get('/reservasi/step-two', [FrontendReservasiController::class, 'stepTwo'])->name('reservasi.step.two');
Route::post('/reservasi/step-two', [FrontendReservasiController::class, 'storeStepTwo'])->name('reservasi.store.step.two');

Route::get('/datareservasi', [DatareservasiController::class, 'index'])->name('datareservasi.index');


Route::get('/terima-kasih', function () {
    return view('terima-kasih');
})->name('terima-kasih');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Awal Route Admin
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/menu', MenuController::class);
    Route::resource('/table', TableController::class);
    Route::resource('/reservasi', ReservasiController::class);
}); // Akhir Route Admin



require __DIR__.'/auth.php';
