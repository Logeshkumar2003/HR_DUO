@extends('layout')

@section('title', 'Post a New Job - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Post a Job</h1>
        <span>Find the right talent for your company</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    
    <div class="mb-4">
      <a href="/jobs" class="text-muted font-weight-bold" style="font-size: 15px;">
        <i class="fa fa-arrow-left mr-1"></i> Back to All Jobs
      </a>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="auth-form-card">
          <h2>Create a Job Listing</h2>
          <p class="text-center text-muted mb-4">Fill out the form below to post your job opportunity.</p>

          <form method="POST" action="/create" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
              <label for="company">Company Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" placeholder="e.g. Acme Corporation" required />
              @error('company')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="title">Job Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Senior PHP / Laravel Developer" required />
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="location">Job Location <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="e.g. Boston, MA or Remote" required />
              @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="email">Contact Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="e.g. jobs@acme.com" required />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="website">Company Website <span class="text-danger">*</span></label>
              <input type="text" inputmode="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="e.g. https://acme.com or www.acme.com" required />
              @error('website')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="application_url">Application URL / Apply Now Link <span class="text-danger">*</span></label>
              <input type="text" inputmode="url" class="form-control @error('application_url') is-invalid @enderror" id="application_url" name="application_url" value="{{ old('application_url') }}" placeholder="e.g. https://company.com/careers/apply/101 or www.linkedin.com/jobs/..." required />
              <small class="form-text text-muted">Direct link where candidates will be redirected when clicking the "Apply Now" button.</small>
              @error('application_url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="tags">Tags (Comma Separated) <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags') }}" placeholder="e.g. laravel, php, backend, api" required />
              <small class="form-text text-muted">Separate tags with commas to make your job searchable.</small>
              @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="logo">Company Logo (Optional)</label>
              <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*" />
              @error('logo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="description">Job Description <span class="text-danger">*</span></label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="7" placeholder="Include responsibilities, requirements, benefits, and salary details..." required>{{ old('description') }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="text-center">
              <button type="submit" class="btn-theme px-5 py-3">
                <i class="fa fa-paper-plane mr-2"></i> Submit & Publish Job
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>

@endsection
