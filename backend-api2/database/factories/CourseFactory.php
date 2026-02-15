<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $levels = ['beginner', 'intermediate', 'advanced'];
        $categories = ['web', 'data', 'design', 'mobile', 'cloud'];
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 9, 199),
            'duration' => $this->faker->numberBetween(4, 60) . ' hours',
            'level' => $this->faker->randomElement($levels),
            'category' => $this->faker->randomElement($categories),
            'target_group' => $this->faker->sentence(6),
            'image' => $this->faker->imageUrl(640, 480, 'education', true),
        ];
    }
}
