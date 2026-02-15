<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Response;

class EnrollmentController extends Controller
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
    public function index(Request $request)
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return $this->respond(true, 'Enrollments', ['items' => $enrollments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
        ]);
        $course = Course::find($data['course_id']);
        if (!$course) {
            return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        }
        $existing = Enrollment::where('user_id', $request->user()->id)
            ->where('course_id', $course->id)->first();
        if ($existing) {
            return $this->respond(true, 'Already enrolled', ['enrollment' => $existing]);
        }
        $enrollment = Enrollment::create([
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);
        return $this->respond(true, 'Enrolled successfully', ['enrollment' => $enrollment], Response::HTTP_CREATED);
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
