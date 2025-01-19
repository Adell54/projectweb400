@extends('layouts.master')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        padding-top: 80px;
    }

    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .section {
        margin-bottom: 30px;
        padding: 20px 0;
        border-bottom: 1px solid #ddd;
    }

    .section-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

 

  
</style>

<div class="container">
    <!-- Admin Panel Section -->
    @if(Auth::check() && \App\Models\Admin::where('user_id', Auth::id())->exists())
        <div class="section">
            <div class="section-header">Admin Panel</div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Panel</a>
        </div>
    @endif

    <!-- Email Update Section -->
    <div class="section">
        <div class="section-header">Update Email</div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="type" value="email">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <button type="submit" class="btn btn-success">Update Email</button>
        </form>
    </div>

    <!-- Password Update Section -->
    <div class="section">
        <div class="section-header">Update Password</div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="type" value="password">
            <div class="form-group mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Update Password</button>
        </form>
    </div>

    <!-- Logout Section -->
    <div class="section">
        <div class="section-header">Logout</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>

@endsection
