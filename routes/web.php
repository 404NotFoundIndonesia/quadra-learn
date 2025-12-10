<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'welcome'])->name('welcome');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('auth.sign-in');
Route::post('/sign-up', [AuthController::class, 'signUp'])->name('auth.sign-up');
Route::post('/sign-out', [AuthController::class, 'signOut'])->name('auth.sign-out');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/account', [ProfileController::class, 'account'])->name('profile.account');
    Route::post('/account', [ProfileController::class, 'accountUpdate'])->name('profile.account-update');
    Route::delete('/account', [ProfileController::class, 'accountDestroy'])->name('profile.account-destroy');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password-update');

    Route::middleware(['role:teacher,admin'])->group(function() {
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');

        Route::patch('/students/{nis}/reset-password', [StudentController::class, 'resetPassword'])->name('students.reset-password');
        Route::delete('/students/{nis}', [StudentController::class, 'destroy'])->name('students.destroy');
    });
});
