<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $isAdmin = $user && $user->role === 'admin';

        $stats = [
            'users' => User::count(),
            'courses' => Course::count(),
            'enrollments' => Enrollment::count(),
            'orders' => Order::count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('amount'),
            'reviews' => Review::count(),
        ];

        $myEnrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(8)
            ->get();

        $recentOrders = Order::with(['course', 'user'])
            ->latest()
            ->limit(8)
            ->get();

        $latestCourses = Course::latest()->limit(8)->get();

        return view('dashboard', compact('user', 'isAdmin', 'stats', 'myEnrollments', 'recentOrders', 'latestCourses'));
    }
}
