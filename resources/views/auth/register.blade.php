<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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

      <!-- Right Register Form Section -->
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <label class="form-label" for="name">Name</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter a valid email address" name="email" value="{{ old('email') }}" required autocomplete="email">
                <label class="form-label" for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter password" name="password" required autocomplete="new-password">
                <label class="form-label" for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password-confirm" class="form-control form-control-lg" placeholder="Confirm your password" name="password_confirmation" required autocomplete="new-password">
                <label class="form-label" for="password-confirm">Confirm Password</label>
            </div>

            <!-- Register Button -->
            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="{{ route('login') }}" class="link-danger">Login</a></p>
            </div>
        </form>
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
