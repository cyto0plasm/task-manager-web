<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profileindex', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::post('/show', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');

    Route::get('/view', [ProjectController::class, 'view'])->name('projects.view');
});
Route::prefix('tasks')->middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::put('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/show/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::patch('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
    
    Route::get('/view', [TaskController::class, 'view'])->name('tasks.view');
});

require __DIR__.'/auth.php';