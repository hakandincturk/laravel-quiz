<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $quizId
 * @property string $question
 * @property string|null $image
 * @property string $answer1
 * @property string $answer2
 * @property string $answer3
 * @property string $answer4
 * @property string $correctAnswer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\QuestionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCorrectAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'image',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correctAnswer',
    ];

    protected $appends = ['TruePercent'];

    public function myAnswer(){
        return $this->hasOne('App\Models\Answer', 'questionId', 'id')->where('userId', auth()->user()->id);
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer', 'questionId', 'id');
    }

    public function getTruePercentAttribute(){
        $answerCount =  $this->answers()->count();
        $trueAnswer=$this->answers()->where('answer', $this->correctAnswer)->count();

        return number_format(100*($trueAnswer/$answerCount), 1, ',', '.');
    }
}
