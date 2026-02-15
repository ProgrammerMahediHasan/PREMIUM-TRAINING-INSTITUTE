@extends('layouts.app')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="p-4 bg-white border rounded shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Dashboard</h4>
                    <div class="text-secondary">Welcome, {{ $user->name }}</div>
                </div>
                <div class="text-end">
                    <span class="badge text-bg-primary">Role: {{ $isAdmin ? 'Admin' : 'Student' }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row g-3">
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Users</div>
                        <div class="fs-4 fw-bold">{{ number_format($stats['users']) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Courses</div>
                        <div class="fs-4 fw-bold">{{ number_format($stats['courses']) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Enrollments</div>
                        <div class="fs-4 fw-bold">{{ number_format($stats['enrollments']) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Orders</div>
                        <div class="fs-4 fw-bold">{{ number_format($stats['orders']) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Revenue</div>
                        <div class="fs-4 fw-bold">৳ {{ number_format($stats['revenue'], 2) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-secondary">Reviews</div>
                        <div class="fs-4 fw-bold">{{ number_format($stats['reviews']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="mb-0">My Enrollments</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Enrolled</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myEnrollments as $en)
                                <tr>
                                    <td>{{ $en->course?->title }}</td>
                                    <td><span class="badge text-bg-success">{{ $en->status }}</span></td>
                                    <td>{{ $en->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3">No enrollments yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($isAdmin)
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Course</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->user?->name }}</td>
                                    <td>{{ $order->course?->title }}</td>
                                    <td>৳ {{ number_format($order->amount, 2) }}</td>
                                    <td><span class="badge {{ $order->payment_status === 'paid' ? 'text-bg-success' : ($order->payment_status === 'failed' ? 'text-bg-danger' : 'text-bg-warning') }}">{{ $order->payment_status }}</span></td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No orders found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="mb-0">Latest Courses</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Price</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestCourses as $course)
                                <tr>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category }}</td>
                                    <td>{{ $course->level }}</td>
                                    <td>৳ {{ number_format($course->price, 2) }}</td>
                                    <td>{{ $course->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No courses found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
