<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?: User::factory(),
            'course_id' => Course::inRandomOrder()->value('id') ?: Course::factory(),
            'status' => $this->faker->randomElement(['active', 'pending', 'completed']),
        ];
    }
}
