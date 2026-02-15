<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $students = User::factory(10)->create();

        $courses = Course::factory(12)->create();

        foreach ($students as $student) {
            $pick = $courses->random(rand(2, 5));
            foreach ($pick as $course) {
                $enrollment = Enrollment::factory()->create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'status' => 'active',
                ]);
                $order = Order::factory()->create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'amount' => $course->price,
                    'payment_status' => 'paid',
                ]);
                Review::factory()->create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
