<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageStudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ManageStudentController::class, 'index'])->name('dashboard');
    Route::get('delete/{id}',[ManageStudentController::class, 'delete'])->name('student.delete');
    Route::get('add/view',[ManageStudentController::class, 'addView'])->name('student.add.view');
    Route::post('add',[ManageStudentController::class, 'add'])->name('student.add');
    Route::get('edit/{id}',[ManageStudentController::class, 'edit'])->name('student.edit');
    Route::post('update',[ManageStudentController::class, 'update'])->name('student.update');
    // Route::get('update/{id}',[ManageStudentController::class, 'delete'])->name('student.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
