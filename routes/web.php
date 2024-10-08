<?php

use App\Http\Controllers\NovelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('novels', NovelController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route::get('/', [NovelController::class, 'index'])->name('novel.index');
// Route::get('/novel',[NovelController::class, 'index'])->name('novel.index');
// Route::get('/novel/create',[NovelController::class, 'create'])->name('novel.create');
// Route::get('/novel/show/{novel}',[NovelController::class, 'show'])->name('novel.show');
// Route::post('/novel',[NovelController::class, 'store'])->name('novel.store');
// Route::get('/novel/edit/{novel}',[NovelController::class, 'edit'])->name('novel.edit');
// Route::put('/novel/update/{novel}',[NovelController::class, 'update'])->name('novel.update');
// Route::delete('/novel/destroy/{novel}',[NovelController::class, 'destroy'])->name('novel.destroy');