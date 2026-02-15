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
        <h5 class="mb-2">Logout</h5>
        <div class="text-secondary mb-3">Are you sure you want to logout?</div>
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-primary px-4" type="submit">Logout</button>
            <a href="/dashboard" class="link-muted ms-3">Cancel</a>
        </form>
    </div>
</div>
@endsection
