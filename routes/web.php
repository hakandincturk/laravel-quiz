<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use \App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('panel', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}', [MainController::class, 'quizDetail'])->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result', [MainController::class, 'result'])->name('quiz.result');
});

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {

    //QUIZ ROUTES
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->whereNumber('id')->name('quizzes.destroy');
    Route::get('quizzes/{id}/details', [QuizController::class, 'show'])->whereNumber('id')->name('quizzes.details');
    Route::resource('quizzes', QuizController::class);

    //QUESTIONS ROUTES
    Route::get('quiz/{quizId}/questions/{id}', [QuestionController::class, 'destroy'])->whereNumber('id')->name('questions.destroy');
    Route::resource('quiz/{quizId}/questions', QuestionController::class);
});
