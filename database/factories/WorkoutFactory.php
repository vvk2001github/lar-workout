<?php

namespace Database\Factories;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ex_id' => rand(1, DatabaseSeeder::COUNTEXERCISES),
            'weight1' => rand(1, 200),
            'weight2' => rand(1, 200),
            'count1' => rand(1, 20),
            'count2' => rand(1, 20),
        ];
    }
}
