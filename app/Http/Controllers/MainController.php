<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

//MODELS
use App\Models\Quiz;
use App\Models\Answer;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes = Quiz::where('status', 'publish')->withCount('questions')->paginate(5);
        return view('dashboard', compact('quizzes'));
    }

    public function quiz($slug){
        $quiz = Quiz::whereSlug($slug)->with('questions.myAnswer')->first() ?? abort(404, 'Quiz bulunumadı.');
        if($quiz->myRank) return view('quizResult', compact('quiz'));
        return view('quiz', compact('quiz'));
    }

    public function quizDetail($slug){
        $quiz = Quiz::where('slug', $slug)->with('myResult', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'Quiz Bulunamadı.');
        return view('quizDetail', compact('quiz'));
    }

    public function result(Request $request, $slug){
        $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404, 'Quiz bulunamadı.');

        if ($quiz->myResult){
            abort(404, 'Bu Quize daha önce katıldınız.');
        }
        $correct = 0;
        $wrong = 0;
        foreach ($quiz->questions as $question){
//            echo $question->id.'-'.$question->correctAnswer.'/'.$request->post($question->id).'<br>';
            Answer::create([
                'userId'=>auth()->user()->id,
                'questionId'=>$question->id,
                'answer'=>$request->post($question->id),
            ]);

            if ($question->correctAnswer === $request->post($question->id)){
                $correct+=1;
            }else $wrong+=1;
        }

        $point = round((100 / count($quiz->questions)) * $correct);
        Result::create([
            'userId'=>auth()->user()->id,
            'quizId'=>$quiz->id,
            'point'=>$point,
            'correct'=>$correct,
            'wrong'=>$wrong,

        ]);

        return redirect()->route('quiz.detail', $slug)->withSuccess('Başarıyla Quizi bitirdin. Puanın:'.$point);
    }
}
