<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard', \App\Http\Controllers\BarangController::class)
    ->middleware(['auth', 'verified'])
    ->names([
        'index' => 'dashboard',
        'search' => 'barang.search',
        'create' => 'barang.tambah',
        'store' => 'barang.store',
        'edit' => 'barang.edit',
        'update' => 'barang.update',
        'destroy' => 'barang.hapus',
    ]);

Route::get('/search', [\App\Http\Controllers\BarangController::class, 'search']);
Route::get('/publish', [\App\Http\Controllers\BarangController::class, 'publish']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
