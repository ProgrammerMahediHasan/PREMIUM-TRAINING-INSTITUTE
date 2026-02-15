<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    private function respond($success, $message, $data = null, $status = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course = Course::find($id);
        if (!$course) return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        $reviews = Review::with('user')->where('course_id', $id)->orderBy('id', 'desc')->get();
        return $this->respond(true, 'Reviews', ['items' => $reviews]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);
        $review = Review::create([
            'user_id' => $request->user()->id,
            'course_id' => $data['course_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);
        return $this->respond(true, 'Review added', ['review' => $review], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
