@extends('layouts.app')
@section('content')
<div class="auth-page">
    <div class="auth-bg"></div>
    <div class="auth-shape-1"></div>
    <div class="auth-shape-2"></div>
    <div class="card card-auth p-3 p-md-4">
        <div class="brand-top mb-2">
            <img src="/images/logo.svg" alt="Logo">
        </div>
        <h5 class="mb-2">Create your account</h5>
        <div class="text-secondary mb-3">Join us and start learning</div>
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="/register" novalidate>
            @csrf
            <div class="mb-2 position-relative">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="form-control padded" value="{{ old('name') }}" placeholder="Username" required>
            </div>
            <div class="mb-2 position-relative">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="form-control padded" value="{{ old('email') }}" placeholder="Email" required>
            </div>
            <div class="mb-2 position-relative">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="form-control padded" placeholder="Password" required>
            </div>
            <div class="mb-3 position-relative">
                <i class="bi bi-shield-check input-icon"></i>
                <input type="password" name="password_confirmation" class="form-control padded" placeholder="Confirm Password" required>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn btn-primary px-4" type="submit">Create Account</button>
                <a class="link-muted" href="/login">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
