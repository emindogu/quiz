<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Result;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'quiz_id' => rand(1, 10),
            'point' => rand(1, 100),
            'correct' => rand(1, 20),
            'wrong' => rand(1, 20),
        ];
    }
}
