@extends('layout')

@section('title', 'Register - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Create Account</h1>
        <span>Sign up to post jobs and connect with candidates</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-8 col-12">
        <div class="auth-form-card">
          <h2>Create Account</h2>
          <p class="text-center text-muted mb-4">Register in seconds to start posting jobs</p>

          <form method="POST" action="/register">
            @csrf

            <div class="form-group mb-3">
              <label for="name">Full Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-user text-muted"></i></span>
                </div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe" required autofocus />
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="email">Email Address</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-envelope text-muted"></i></span>
                </div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="e.g. john@example.com" required />
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-lock text-muted"></i></span>
                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="At least 6 characters" required />
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group mb-4">
              <label for="password_confirmation">Confirm Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-lock text-muted"></i></span>
                </div>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required />
              </div>
            </div>

            <button type="submit" class="btn-theme btn-block py-3 mb-3">
              <i class="fa fa-user-plus mr-2"></i> Register Account
            </button>

            <div class="text-center text-muted mt-3">
              Already have an account? <a href="/login" style="color: #a4c639; font-weight: 600;">Log in here</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
