<?php

use App\Http\Controllers\{ProfileController, QuestionController};
use App\Livewire\TypeIvenstiment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
