<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ProfileController,
    RoleAndPermissionController
};


Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'));

    Route::get('/profile', ProfileController::class)->name('profile');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});

Route::resource('items', App\Http\Controllers\ItemController::class)->middleware('auth');
Route::resource('school-grades', App\Http\Controllers\SchoolGradeController::class)->middleware('auth');
Route::resource('classes', App\Http\Controllers\ClassController::class)->middleware('auth');
Route::resource('classrooms', App\Http\Controllers\ClassroomController::class)->middleware('auth');

Route::resource('classrooms', App\Http\Controllers\ClassroomController::class)->middleware('auth');

Route::resource('school-grades', App\Http\Controllers\SchoolGradeController::class)->middleware('auth');
Route::resource('classrooms', App\Http\Controllers\ClassroomController::class)->middleware('auth');
Route::resource('units', App\Http\Controllers\UnitController::class)->middleware('auth');
Route::resource('subjects', App\Http\Controllers\SubjectController::class)->middleware('auth');
Route::resource('subjects', App\Http\Controllers\SubjectController::class)->middleware('auth');
Route::resource('units', App\Http\Controllers\UnitController::class)->middleware('auth');
Route::resource('lessons', App\Http\Controllers\LessonController::class)->middleware('auth');
Route::resource('questions', App\Http\Controllers\QuestionController::class)->middleware('auth');
Route::resource('answers', App\Http\Controllers\AnswerController::class)->middleware('auth');
Route::resource('results', App\Http\Controllers\ResultController::class)->middleware('auth');
Route::resource('marks', App\Http\Controllers\MarkController::class)->middleware('auth');
Route::resource('tips', App\Http\Controllers\TipController::class)->middleware('auth');
Route::resource('blogs', App\Http\Controllers\BlogController::class)->middleware('auth');
Route::resource('profiles', App\Http\Controllers\UserProfileController::class)->middleware('auth');

Route::get('answerbyquestion/{q_id}',[ App\Http\Controllers\AnswerController::class, 'answerByQuestion' ])->name('answerbyquestion');
