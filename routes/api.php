<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





//SchoolGrade
Route::get('school-grades', [App\Http\Controllers\Api\SchoolGradeController::class, 'list']);
Route::post('schoolGrade-create', [App\Http\Controllers\Api\SchoolGradeController::class, 'save']);
Route::get('schoolGrade/{id}', [App\Http\Controllers\Api\SchoolGradeController::class, 'view']);
Route::get('schoolGrade/delete/{id}', [App\Http\Controllers\Api\SchoolGradeController::class, 'delete']);
Route::post('schoolGrade/edit/{id}', [App\Http\Controllers\Api\SchoolGradeController::class, 'edit']);




//Classroom
Route::get('classrooms', [App\Http\Controllers\Api\ClassroomController::class, 'list']);
Route::post('classroom-create', [App\Http\Controllers\Api\ClassroomController::class, 'save']);
Route::get('classroom/{id}', [App\Http\Controllers\Api\ClassroomController::class, 'view']);
Route::get('classroom/delete/{id}', [App\Http\Controllers\Api\ClassroomController::class, 'delete']);
Route::post('classroom/edit/{id}', [App\Http\Controllers\Api\ClassroomController::class, 'edit']);





//Subjects
Route::get('subjects', [App\Http\Controllers\Api\SubjectController::class, 'list']);
Route::post('subject-create', [App\Http\Controllers\Api\SubjectController::class, 'save']);
Route::get('subject/{id}', [App\Http\Controllers\Api\SubjectController::class, 'view']);
Route::get('subject/delete/{id}', [App\Http\Controllers\Api\SubjectController::class, 'delete']);
Route::post('subject/edit/{id}', [App\Http\Controllers\Api\SubjectController::class, 'edit']);





//Units
Route::get('units', [App\Http\Controllers\Api\UnitController::class, 'list']);
Route::post('unit-create', [App\Http\Controllers\Api\UnitController::class, 'save']);
Route::get('unit/{id}', [App\Http\Controllers\Api\UnitController::class, 'view']);
Route::get('unit/delete/{id}', [App\Http\Controllers\Api\UnitController::class, 'delete']);
Route::post('unit/edit/{id}', [App\Http\Controllers\Api\UnitController::class, 'edit']);





//Lesson
Route::get('lessons', [App\Http\Controllers\Api\LessonController::class, 'list']);
Route::post('lesson-create', [App\Http\Controllers\Api\LessonController::class, 'save']);
Route::get('lesson/{id}', [App\Http\Controllers\Api\LessonController::class, 'view']);
Route::get('lesson/delete/{id}', [App\Http\Controllers\Api\LessonController::class, 'delete']);
Route::post('lesson/edit/{id}', [App\Http\Controllers\Api\LessonController::class, 'edit']);





//Question
Route::get('questions', [App\Http\Controllers\Api\QuestionController::class, 'list']);
Route::post('question-create', [App\Http\Controllers\Api\QuestionController::class, 'save']);
Route::get('question/{id}', [App\Http\Controllers\Api\QuestionController::class, 'view']);
Route::get('question/delete/{id}', [App\Http\Controllers\Api\QuestionController::class, 'delete']);
Route::post('question/edit/{id}', [App\Http\Controllers\Api\QuestionController::class, 'edit']);





//Answer
Route::get('answers', [App\Http\Controllers\Api\AnswerController::class, 'list']);
Route::post('answer-create', [App\Http\Controllers\Api\AnswerController::class, 'save']);
Route::get('answer/{id}', [App\Http\Controllers\Api\AnswerController::class, 'view']);
Route::get('answer/delete/{id}', [App\Http\Controllers\Api\AnswerController::class, 'delete']);
Route::post('answer/edit/{id}', [App\Http\Controllers\Api\AnswerController::class, 'edit']);




//Result
Route::get('results', [App\Http\Controllers\Api\ResultController::class, 'list']);
Route::post('result-create', [App\Http\Controllers\Api\ResultController::class, 'save']);
Route::get('result/{id}', [App\Http\Controllers\Api\ResultController::class, 'view']);
Route::get('result/delete/{id}', [App\Http\Controllers\Api\ResultController::class, 'delete']);
Route::post('result/edit/{id}', [App\Http\Controllers\Api\ResultController::class, 'edit']);




//Mark
Route::get('marks', [App\Http\Controllers\Api\MarkController::class, 'list']);
Route::post('mark-create', [App\Http\Controllers\Api\MarkController::class, 'save']);
Route::get('mark/{id}', [App\Http\Controllers\Api\MarkController::class, 'view']);
Route::get('mark/delete/{id}', [App\Http\Controllers\Api\MarkController::class, 'delete']);
Route::post('mark/edit/{id}', [App\Http\Controllers\Api\MarkController::class, 'edit']);





//Tips
Route::get('tips', [App\Http\Controllers\Api\TipController::class, 'list']);
Route::post('tip-create', [App\Http\Controllers\Api\TipController::class, 'save']);
Route::get('tip/{id}', [App\Http\Controllers\Api\TipController::class, 'view']);
Route::get('tip/delete/{id}', [App\Http\Controllers\Api\TipController::class, 'delete']);
Route::post('tip/edit/{id}', [App\Http\Controllers\Api\TipController::class, 'edit']);




//Blog
Route::get('blogs', [App\Http\Controllers\Api\BlogController::class, 'list']);
Route::post('blog-create', [App\Http\Controllers\Api\BlogController::class, 'save']);
Route::get('blog/{id}', [App\Http\Controllers\Api\BlogController::class, 'view']);
Route::get('blog/delete/{id}', [App\Http\Controllers\Api\BlogController::class, 'delete']);
Route::post('blog/edit/{id}', [App\Http\Controllers\Api\BlogController::class, 'edit']);





//Profile
Route::get('profiles', [App\Http\Controllers\Api\ProfileController::class, 'list']);
Route::post('profile-create', [App\Http\Controllers\Api\ProfileController::class, 'save']);
Route::get('profile/{id}', [App\Http\Controllers\Api\ProfileController::class, 'view']);
Route::get('profile/delete/{id}', [App\Http\Controllers\Api\ProfileController::class, 'delete']);
Route::post('profile/edit/{id}', [App\Http\Controllers\Api\ProfileController::class, 'edit']);
