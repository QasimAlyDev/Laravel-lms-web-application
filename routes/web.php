<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified','role:admin'])->prefix('admin')->group(function () {
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [AdminController::class, 'destroy'])->name('admin.logout');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
