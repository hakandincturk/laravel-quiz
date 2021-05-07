<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * App\Models\Quiz
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property string|null $finished_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Database\Factories\QuizFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'status',
        'finished_at',
        'slug',
    ];
    protected $appends = ['details', 'myRank'];
    protected $dates=['finished_at'];

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'quizId', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function myResult(){
        return $this->hasOne('App\Models\Result', 'quizId', 'id')->where('userId', auth()->user()->id);
    }

    public function results(){
        return $this->hasMany('App\Models\Result', 'quizId', 'id');
    }

    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function getMyRankAttribute(){
        $rank =0;
        foreach ($this->results()->orderByDesc('point')->get() as $result){
            $rank+=1;
            if (auth()->user()->id == $result->userId){
                return $rank;
            }
        }
    }

    /**
     * @return array|null
     */
    public function getDetailsAttribute(){
        if($this->results()->count()>0){
            return [
                'average' => round($this->results()->get()->avg('point')),
                'joinedCount' => $this->results()->count(),
            ];
        }
        return null;
    }
}
