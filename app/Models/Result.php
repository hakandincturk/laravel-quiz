<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Result
 *
 * @property int $id
 * @property int $userId
 * @property int $quizId
 * @property int $point
 * @property int $correct
 * @property int $wrong
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ResultFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereWrong($value)
 * @mixin \Eloquent
 */
class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'quizId',
        'point',
        'correct',
        'wrong',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }

    public function quiz(){
        return $this->belongsTo('App\Models\Quiz', 'quizId', 'id');
    }
}
