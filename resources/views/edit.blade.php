@extends('layout')

@section('title', 'Edit: ' . $listing->title . ' - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Edit Job Listing</h1>
        <span>Update your job details and requirements</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    
    <div class="mb-4">
      <a href="/listings/{{ $listing->id }}" class="text-muted font-weight-bold" style="font-size: 15px;">
        <i class="fa fa-arrow-left mr-1"></i> Back to Listing
      </a>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="auth-form-card">
          <h2>Edit: {{ $listing->title }}</h2>

          <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
              <label for="company">Company Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company', $listing->company) }}" required />
              @error('company')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="title">Job Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $listing->title) }}" required />
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="location">Job Location <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $listing->location) }}" required />
              @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="email">Contact Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $listing->email) }}" required />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="website">Company Website <span class="text-danger">*</span></label>
              <input type="text" inputmode="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $listing->website) }}" placeholder="e.g. https://acme.com or www.acme.com" required />
              @error('website')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="application_url">Application URL / Apply Now Link <span class="text-danger">*</span></label>
              <input type="text" inputmode="url" class="form-control @error('application_url') is-invalid @enderror" id="application_url" name="application_url" value="{{ old('application_url', $listing->application_url) }}" placeholder="e.g. https://company.com/careers/apply/101 or www.linkedin.com/jobs/..." required />
              <small class="form-text text-muted">Direct link where candidates will be redirected when clicking the "Apply Now" button.</small>
              @error('application_url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="tags">Tags (Comma Separated) <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', $listing->tags) }}" required />
              @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="logo">Update Company Logo (Optional)</label>
              @if($listing->logo)
              <div class="mb-2">
                <img src="{{ asset('storage/' . $listing->logo) }}" alt="Current Logo" style="height: 50px; object-fit: contain;">
                <small class="text-muted ml-2">Current Logo</small>
              </div>
              @endif
              <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*" />
              @error('logo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="description">Job Description <span class="text-danger">*</span></label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="7" required>{{ old('description', $listing->description) }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="text-center">
              <button type="submit" class="btn-theme px-5 py-3">
                <i class="fa fa-save mr-2"></i> Update Listing
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>

@endsection
