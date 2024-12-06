<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/voter', [UserController::class, 'voters'])->name('voter.index');
    Route::resource('admin/candidate', CandidateController::class);
});

Route::get('/', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('candidate.index');
    } elseif (auth()->user()->hasRole('voter')) {
        return redirect()->route('dashboard');
    }
})->middleware(['auth']);


Route::middleware(['auth', 'role:voter'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/voter_update', [UserController::class, 'voter_update'])->name('voter_update');
});


Route::middleware('auth')->group(function () {
    Route::get('/candidate/{candidate}/resume', [CandidateController::class, 'downloadResume'])->name('candidate.resume.download');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
