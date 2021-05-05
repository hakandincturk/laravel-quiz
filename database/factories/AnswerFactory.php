<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

//MODELS
use App\Models\Answer;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'userId'=>rand(1,10),
            'questionId' => rand(1,100),
            'answer'=>'answer'.rand(1,4),
        ];
    }
}
