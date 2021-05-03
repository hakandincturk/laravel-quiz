<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->get('/panel', function () {

    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {

    //QUIZ ROUTES
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->whereNumber('id')->name('quizzes.destroy');
    Route::resource('quizzes', QuizController::class);

    //QUESTIONS ROUTES
    Route::resource('quiz/{quizId}/questions', QuestionController::class);
});
