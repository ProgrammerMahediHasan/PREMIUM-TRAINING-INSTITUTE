@extends('layouts.app')
@section('content')
<div class="auth-page">
    <div class="auth-bg"></div>
    <div class="auth-shape-1"></div>
    <div class="auth-shape-2"></div>
    <div class="card card-auth p-4 p-md-5">
        <div class="brand-top mb-3">
            <img src="/images/logo.svg" alt="Logo">
        </div>
        <h4 class="mb-2">Welcome back</h4>
        <div class="text-secondary mb-4">Login into your account to continue</div>
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="/login" novalidate>
            @csrf
            <div class="mb-3 position-relative">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="form-control padded" value="{{ old('name') }}" placeholder="Username" required>
            </div>
            <div class="mb-4 position-relative">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="form-control padded" placeholder="Password" required>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn btn-primary px-4" type="submit">Log In</button>
                <a class="link-muted" href="/register">Create account</a>
            </div>
        </form>
    </div>
</div>
@endsection
