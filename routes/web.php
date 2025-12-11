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

    // Student routes
    Route::middleware(['role:student'])->prefix('s')->name('student.')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

        Route::get('learning-materials/{learningMaterial}', [App\Http\Controllers\Student\LearningMaterialController::class, 'show'])->name('learning-materials.show');
        Route::post('learning-materials/{learningMaterial}/questions/{question}/answer', [App\Http\Controllers\Student\LearningMaterialController::class, 'submitAnswer'])->name('learning-materials.submit-answer');
    });

    // Admin routes
    Route::middleware(['role:admin'])->prefix('a')->name('admin.')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('learning-materials', App\Http\Controllers\Admin\LearningMaterialController::class);
        Route::delete('attachments/{attachment}', [App\Http\Controllers\Admin\LearningMaterialController::class, 'deleteAttachment'])->name('attachments.destroy');

        Route::resource('questions', App\Http\Controllers\Admin\QuestionController::class);

        Route::resource('grades', App\Http\Controllers\Admin\GradeController::class);
        Route::post('grades/{grade}/assign-student', [App\Http\Controllers\Admin\GradeController::class, 'assignStudent'])->name('grades.assign-student');
        Route::delete('grades/{grade}/students/{student}', [App\Http\Controllers\Admin\GradeController::class, 'removeStudent'])->name('grades.remove-student');

        Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
        Route::post('students/bulk-action', [App\Http\Controllers\Admin\StudentController::class, 'bulkAction'])->name('students.bulk-action');
        Route::post('students/{student}/reset-password', [App\Http\Controllers\Admin\StudentController::class, 'resetPassword'])->name('students.reset-password');

        Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);
        Route::post('teachers/bulk-action', [App\Http\Controllers\Admin\TeacherController::class, 'bulkAction'])->name('teachers.bulk-action');
        Route::post('teachers/{teacher}/reset-password', [App\Http\Controllers\Admin\TeacherController::class, 'resetPassword'])->name('teachers.reset-password');
        Route::post('teachers/{teacher}/assign-grade', [App\Http\Controllers\Admin\TeacherController::class, 'assignGrade'])->name('teachers.assign-grade');
        Route::delete('teachers/{teacher}/grades/{grade}', [App\Http\Controllers\Admin\TeacherController::class, 'removeGrade'])->name('teachers.remove-grade');
    });
});
