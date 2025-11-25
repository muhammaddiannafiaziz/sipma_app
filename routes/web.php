<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\RegisterSantri;

Route::get('/', function () {
    return view('welcome');
});

// Route Pendaftaran Santri
Route::get('/register-santri', RegisterSantri::class)->name('register.santri');
