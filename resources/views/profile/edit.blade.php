@extends('layouts.master')

@section('content')
<style>
    body {
        
        font-family: 'Arial', sans-serif;
       
    }

    .container {
        max-width: 800px;
        
        
       
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .section-header {
        font-size: 20px;
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

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
    }

    .alert {
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<div class="container mt-80 mb-80">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Admin Panel Section -->
    @if(Auth::check() && \App\Models\Admin::where('user_id', Auth::id())->exists())
        <div class="section">
            <div class="section-header">Admin Panel</div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Panel</a>
        </div>
    @endif

    <!-- Email Update Section -->
    <div class="section mt-80 mb-80">
        <div class="section-header">Update Email</div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="type" value="email">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
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

    <!-- Order Tracking Section -->
    <div class="section">
        <div class="section-header">Track Orders</div>
        <a href="/profile/orders" class="btn btn-info">Check Orders</a>
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
