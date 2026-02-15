<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Public courses and reviews
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::get('/courses/{id}/reviews', [ReviewController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/profile', [AuthController::class, 'profile']);

        // Courses CRUD (admin only in controller)
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{id}', [CourseController::class, 'update']);
        Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

        // Enrollments
        Route::post('/enrollments', [EnrollmentController::class, 'store']);
        Route::get('/enrollments', [EnrollmentController::class, 'index']);

        // Orders
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::patch('/orders/{id}/payment-status', [OrderController::class, 'updatePaymentStatus']);

        // Reviews
        Route::post('/courses/{id}/reviews', [ReviewController::class, 'store']);
    });
});
