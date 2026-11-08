@extends('layout')

@section('title', 'Admin Login - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Admin Portal</h1>
        <span>Administrator authentication and portal access</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-8 col-12">
        <div class="auth-form-card">
          <h2>Administrator Login</h2>
          <p class="text-center text-muted mb-4">Enter your authorized credentials to access management</p>

          <form method="POST" action="/login">
            @csrf

            <div class="form-group mb-3">
              <label for="email">Admin Email ID</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-envelope text-muted"></i></span>
                </div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus />
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group mb-4">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fa fa-lock text-muted"></i></span>
                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required />
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <button type="submit" class="btn-theme btn-block py-3 mb-2">
              <i class="fa fa-sign-in mr-2"></i> Log In to Dashboard
            </button>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
