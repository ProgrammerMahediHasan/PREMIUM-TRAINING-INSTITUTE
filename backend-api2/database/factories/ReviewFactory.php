<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?: User::factory(),
            'course_id' => Course::inRandomOrder()->value('id') ?: Course::factory(),
            'rating' => $this->faker->numberBetween(3, 5),
            'comment' => $this->faker->sentence(12),
        ];
    }
}
