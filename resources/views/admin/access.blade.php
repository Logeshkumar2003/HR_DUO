@extends('layout')

@section('title', 'Admin Access Management - Job Agency Website')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Admin Access Management</h1>
        <span>Exclusive access control panel for the Main Administrator</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
      <div>
        <h3 class="font-weight-bold mb-1" style="color: #232323;">Administrator Access Control</h3>
        <p class="text-muted mb-0">Only the permanent Main Admin can grant or revoke secondary admin permissions.</p>
      </div>
      <div class="mt-2 mt-md-0">
        <a href="/manage" class="btn-theme-outline" style="padding: 8px 20px; font-size: 13px;">
          <i class="fa fa-briefcase mr-1"></i> Manage Job Postings
        </a>
      </div>
    </div>

    @if(session('error'))
      <div class="mb-4 p-3 rounded" style="background-color: #fdf0f0; border-left: 4px solid #d9534f; color: #a94442;">
        <strong>Error:</strong> {{ session('error') }}
      </div>
    @endif
    @if(session('message'))
      <div class="mb-4 p-3 rounded" style="background-color: #f3f9ec; border-left: 4px solid #a4c639; color: #3c763d;">
        <strong>Success:</strong> {{ session('message') }}
      </div>
    @endif

    <div class="row">
      <!-- Grant Admin Access Form -->
      <div class="col-lg-5 mb-4">
        <div class="auth-form-card h-100">
          <h4 class="font-weight-bold mb-3" style="color: #232323;">
            <i class="fa fa-user-plus mr-2" style="color: #a4c639;"></i> Grant Admin Access
          </h4>
          <p class="text-muted small mb-4">
            Enter the email and password for the new secondary admin. Credentials are securely encrypted and hashed in the database.
          </p>

          <form method="POST" action="/admin/access">
            @csrf

            <div class="form-group mb-3">
              <label for="name" class="font-weight-bold">Administrator Name (Optional)</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe (Secondary Admin)" />
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="email" class="font-weight-bold">Email ID <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="password" class="font-weight-bold">Password <span class="text-danger">*</span></label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimum 6 characters" required />
              <small class="form-text text-muted">Passwords are cryptographically hashed using bcrypt.</small>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn-theme btn-block py-3">
              <i class="fa fa-save mr-2"></i> Save & Grant Admin Access
            </button>
          </form>

        </div>
      </div>

      <!-- Current Administrators List -->
      <div class="col-lg-7 mb-4">
        <div class="bg-white rounded p-4 shadow-sm border h-100">
          <h4 class="font-weight-bold mb-3" style="color: #232323;">
            <i class="fa fa-users mr-2" style="color: #a4c639;"></i> Current Administrators
          </h4>
          <p class="text-muted small mb-4">
            The active list of users authorized to manage job postings. Secondary admins can be revoked at any time.
          </p>

          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Administrator</th>
                  <th scope="col">Role</th>
                  <th scope="col">Created On</th>
                  <th scope="col" class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($admins as $admin)
                  <tr>
                    <td>
                      <div class="font-weight-bold text-dark">{{ $admin->name ?: 'Administrator' }}</div>
                      <div class="text-muted small">{{ $admin->email }}</div>
                    </td>
                    <td>
                      @if($admin->isMainAdmin())
                        <span class="badge badge-success px-2 py-1" style="font-size: 11px;">
                          <i class="fa fa-shield"></i> Main Admin
                        </span>
                      @else
                        <span class="badge badge-info px-2 py-1" style="font-size: 11px;">
                          Secondary Admin
                        </span>
                      @endif
                    </td>
                    <td>
                      <small class="text-muted">{{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}</small>
                    </td>
                    <td class="text-right">
                      @if($admin->isMainAdmin())
                        <span class="text-muted small font-italic">
                          <i class="fa fa-lock mr-1"></i> Permanent
                        </span>
                      @else
                        <form method="POST" action="/admin/access/{{ $admin->id }}" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 20px; padding: 4px 12px; font-size: 12px;">
                            <i class="fa fa-trash mr-1"></i> Revoke
                          </button>
                        </form>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="mt-4 p-3 bg-light rounded" style="font-size: 13px;">
            <i class="fa fa-info-circle text-primary mr-1"></i>
            <strong>Security Notice:</strong> Only the permanent Main Admin (<code>{{ config('admin.main_admin_email', 'Nitta.prasanthi19@gmail.com') }}</code>) can access this page and manage secondary admin credentials. Secondary admins are blocked from accessing this functionality.
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

@endsection

