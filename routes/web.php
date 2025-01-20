<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function (){

    Route::post('/championships', \App\Livewire\Admin\Championship\Create::class)->name('championships.store');
    Route::put('/championships/{championship}', \App\Livewire\Admin\Championship\Update::class)->name('championships.update');
    Route::delete('/championships/{championship}', \App\Livewire\Admin\Championship\Delete::class)->name('championships.delete');






});

require __DIR__.'/auth.php';
