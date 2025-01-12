@extends('layouts.master')

@section('content')
<style>
    /* Adjust body padding for fixed header */
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        padding-top: 80px; /* Adjust based on the height of your fixed header */
    }

    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .card-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
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
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
        border: none;
        text-align: center;
        transition: all 0.3s;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .section-header {
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
        color: #555;
    }

    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Edit Profile</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('POST')
                
                <!-- Username Section -->
                <div class="section-header">Username</div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>

                <!-- Email Section -->
                <div class="section-header">Email</div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                </div>

                <!-- Password Section -->
                <div class="section-header">Password</div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <!-- Update Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </div>
            </form>
            
            <!-- Delete Profile -->
            <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile?');" class="mt-4 text-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
