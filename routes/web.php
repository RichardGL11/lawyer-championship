<?php

use App\Livewire\Admin\Championship\AcceptTeamInvitation;
use App\Livewire\Admin\Championship\Create;
use App\Livewire\Admin\Championship\Delete;
use App\Livewire\Admin\Championship\Update;
use App\Livewire\Championship\ShowChampionshipDetails;
use App\Livewire\Teams\AccepInvitationRequest;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function (){

    Route::post('/championships', Create::class)->name('championships.store');
    Route::put('/championships/{championship}', Update::class)->name('championships.update');
    Route::delete('/championships/{championship}', Delete::class)->name('championships.delete');
    Route::get('/championships/{championship}', ShowChampionshipDetails::class)->name('championships.show');

    Route::post('/accep-invitation/{user}/{team}', AccepInvitationRequest::class)->name('accept.invitation');
    Route::post('/accep-team-invitation/{team}', AcceptTeamInvitation::class)->name('accept.team.invitation');
});

require __DIR__.'/auth.php';
