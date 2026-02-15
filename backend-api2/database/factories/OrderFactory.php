<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $courseId = Course::inRandomOrder()->value('id') ?: Course::factory();
        $userId = User::inRandomOrder()->value('id') ?: User::factory();
        $amount = \App\Models\Course::find($courseId)->price ?? $this->faker->randomFloat(2, 9, 199);
        return [
            'user_id' => $userId,
            'course_id' => $courseId,
            'amount' => $amount,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
        ];
    }
}
