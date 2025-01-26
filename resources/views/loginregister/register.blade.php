@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px; border-radius: 12px; box-shadow: 0 4px 8px 0 #007bff;">
        <!-- Header -->
        <div class="text-center mb-4">
            <h3>Create an Account</h3>
            <p class="text-muted">Join us and start your journey</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter your full name" 
                    value="{{ old('name') }}" 
                    required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Enter your email" 
                    value="{{ old('email') }}" 
                    required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Create a password" 
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    id="password-confirm" 
                    name="password_confirmation" 
                    class="form-control" 
                    placeholder="Confirm your password" 
                    required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn" style="background-color: #F28123; color: white;">Register</button>
            </div>
        </form>

        <!-- Divider -->
        <hr class="my-4">

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-muted">Already have an account? 
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">Log in</a>
            </p>
        </div>
    </div>
</div>

<style>
    .card:hover {
        box-shadow: 0 4px 8px 0 #F28123;
    }
    a.text-primary:hover {
        color: #F28123;
    }
</style>
@endsection