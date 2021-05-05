<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

//MODELS
use App\Models\Quiz;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes = Quiz::where('status', 'publish')->withCount('questions')->paginate(5);
        return view('dashboard', compact('quizzes'));
    }

    public function quizDetail($slug){
        $quiz = Quiz::where('slug', $slug)->withCount('questions')->first() ?? abort(404, 'Quiz Bulunamadı.');
        return view('quizDetail', compact('quiz'));
    }
}
