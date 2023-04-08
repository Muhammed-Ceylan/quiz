<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
