<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('panel', [MainController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('quiz/detail/{slug}', [MainController::class, 'quiz_detail'])
        ->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])
        ->name('quiz.join');
});

Route::group([
    'middleware' => ['auth', 'isAdmin'],
    'prefix' => 'admin',
], function () {
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])
        ->whereNumber('id')
        ->name('quizzes.destroy');
    Route::get('quiz/{quiz_id}/questions/{id}', [QuestionController::class, 'destroy'])
        ->whereNumber('id')
        ->name('questions.destroy');
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz/{quiz_id}/questions', QuestionController::class);
});
