<?php

use App\Http\Controllers\{ProfileController};
use App\Livewire\TypeIvenstiment;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/actions', \App\Livewire\Actions::class)->name('actions');
    #region Type Investiment Controller
    Route::get('/type-investments', TypeIvenstiment::class)->name('type_investiments');
    #endregion

    #region Profile Controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    #endregison
});

require __DIR__ . '/auth.php';
