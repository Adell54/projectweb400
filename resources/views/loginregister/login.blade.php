@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px; border-radius: 12px; box-shadow: 0 4px 8px 0 #F28123;">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="h3">Welcome Back</h1>
            <p class="text-muted">Login to access your account</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    required autofocus>
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
                    placeholder="Enter your password" 
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="remember" 
                        name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn" style="background-color: #F28123; color: white;">Log In</button>
            </div>
        </form>

        <!-- Divider -->
        <hr class="my-4">

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-muted">Don't have an account? 
                <a href="{{ route('register') }}" class="text-decoration-none text-primary">Sign up</a>
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