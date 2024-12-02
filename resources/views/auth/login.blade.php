<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet"> <!-- Link ke file CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
@extends('layouts.app')

@section('content')
<section class="vh-100" style="background: linear-gradient(135deg, #00aaff, #0044cc);">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <!-- Left Image Section -->
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
      </div>

      <!-- Right Login Form Section -->
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email input with Icon -->
            <div class="form-outline mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter a valid email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <label class="form-label" for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password input with Icon -->
            <div class="form-outline mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter password" name="password" required autocomplete="current-password">
                </div>
                <label class="form-label" for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#!" class="text-body">Forgot password?</a>
            </div>

            <!-- Login Button -->
            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}" class="link-danger">Register</a></p>
            </div>
        </form>

        <!-- Social Login Section -->
        <div class="text-center mt-3">
            <p>Or login with:</p>
            <button class="btn btn-outline-dark me-2"><i class="fab fa-facebook-f"></i> Facebook</button>
            <button class="btn btn-outline-dark me-2"><i class="fab fa-google"></i> Google</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <div class="text-white mb-3 mb-md-0">Copyright © 2020. All rights reserved.</div>
    <div>
      <a href="#!" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-twitter"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-google"></i></a>
      <a href="#!" class="text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
</section>
@endsection
