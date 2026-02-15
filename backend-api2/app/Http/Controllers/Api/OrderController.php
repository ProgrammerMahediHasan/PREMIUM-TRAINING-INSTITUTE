<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Response;

class OrderController extends Controller
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
        $orders = Order::with('course')
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return $this->respond(true, 'Orders', ['items' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);
        $course = Course::find($data['course_id']);
        if (!$course) return $this->respond(false, 'Course not found', null, Response::HTTP_NOT_FOUND);
        $order = Order::create([
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'amount' => $data['amount'],
            'payment_status' => 'pending',
        ]);
        return $this->respond(true, 'Order created', ['order' => $order], Response::HTTP_CREATED);
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

    public function updatePaymentStatus(Request $request, string $id)
    {
        $data = $request->validate([
            'payment_status' => ['required', 'string', 'in:pending,paid,failed,refunded'],
        ]);
        $order = Order::find($id);
        if (!$order) return $this->respond(false, 'Order not found', null, Response::HTTP_NOT_FOUND);
        // Allow only owner or admin to update
        $user = $request->user();
        if ($user->id !== $order->user_id && $user->role !== 'admin') {
            return $this->respond(false, 'Forbidden', null, Response::HTTP_FORBIDDEN);
        }
        $order->payment_status = $data['payment_status'];
        $order->save();
        return $this->respond(true, 'Payment status updated', ['order' => $order]);
    }
}
