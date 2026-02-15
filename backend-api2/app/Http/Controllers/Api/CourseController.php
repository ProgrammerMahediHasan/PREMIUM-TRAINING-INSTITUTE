<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Http\Response;

class CourseController extends Controller
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
        $q = $request->string('q')->toString();
        $level = $request->string('level')->toString();
        $category = $request->string('category')->toString();
        $perPage = (int) ($request->integer('per_page')->value() ?? 10);

        $query = Course::query();
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%$q%")
                  ->orWhere('description', 'like', "%$q%");
            });
        }
        if ($level) $query->where('level', $level);
        if ($category) $query->where('category', $category);

        $p = $query->orderBy('id', 'desc')->paginate($perPage);
        return $this->respond(true, 'Courses', [
            'items' => $p->items(),
            'pagination' => [
                'total' => $p->total(),
                'per_page' => $p->perPage(),
                'current_page' => $p->currentPage(),
                'last_page' => $p->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user || $user->role !== 'admin') {
            return $this->respond(false, 'Forbidden', null, Response::HTTP_FORBIDDEN);
        }
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:100'],
            'level' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'target_group' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
        ]);
        $course = Course::create($data);
        return $this->respond(true, 'Course created', ['course' => $course], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if (!$course) return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        return $this->respond(true, 'Course', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->user();
        if (!$user || $user->role !== 'admin') {
            return $this->respond(false, 'Forbidden', null, Response::HTTP_FORBIDDEN);
        }
        $course = Course::find($id);
        if (!$course) return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:100'],
            'level' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'target_group' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
        ]);
        $course->update($data);
        return $this->respond(true, 'Course updated', ['course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = request()->user();
        if (!$user || $user->role !== 'admin') {
            return $this->respond(false, 'Forbidden', null, Response::HTTP_FORBIDDEN);
        }
        $course = Course::find($id);
        if (!$course) return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        $course->delete();
        return $this->respond(true, 'Course deleted');
    }
}
