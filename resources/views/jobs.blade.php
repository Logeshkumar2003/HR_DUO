@extends('layout')

@section('title', 'Job Listings - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Job Listings</h1>
        <span>Explore and apply for the latest job opportunities</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    
    <!-- Search Section -->
    @include('partials._search')

    <!-- Popular Tags -->
    <div class="mb-4 text-center">
      <span class="text-muted mr-2" style="font-weight: 600; font-size: 14px;">Popular Tags:</span>
      <a href="/jobs?tag=laravel" class="tag-badge">Laravel</a>
      <a href="/jobs?tag=php" class="tag-badge">PHP</a>
      <a href="/jobs?tag=backend" class="tag-badge">Backend</a>
      <a href="/jobs?tag=frontend" class="tag-badge">Frontend</a>
      <a href="/jobs?tag=fullstack" class="tag-badge">Fullstack</a>
      <a href="/jobs?tag=api" class="tag-badge">API</a>
      <a href="/jobs?tag=javascript" class="tag-badge">JavaScript</a>
    </div>

    <!-- Jobs Grid -->
    <div class="row">
      @if(count($listings) > 0)
        @foreach($listings as $listing)
          <div class="col-lg-6 col-md-6 col-12 mb-4 d-flex align-items-stretch">
            <div class="job-listing-card w-100">
              <div>
                <div class="job-card-header">
                  <a href="/listings/{{ $listing->id }}">
                    <img src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('img/nologo.jpg') }}" alt="{{ $listing->company }} logo" class="job-card-logo">
                  </a>
                  <div class="flex-grow-1">
                    <h3 class="job-card-title">
                      <a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a>
                    </h3>
                    <div class="job-card-company">{{ $listing->company }}</div>
                    <div class="job-card-location">
                      <i class="fa fa-map-marker"></i> {{ $listing->location }}
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <x-listing-tags :tags="$listing->tags" />
                </div>

                <div class="job-card-description">
                  {{ \Illuminate\Support\Str::limit($listing->description, 130) }}
                </div>
              </div>

              <div class="job-card-footer">
                <div>
                  <small class="text-muted">
                    <i class="fa fa-clock-o mr-1"></i> {{ $listing->created_at ? $listing->created_at->diffForHumans() : 'Recently' }}
                  </small>
                </div>
                <div>
                  <a href="/listings/{{ $listing->id }}" class="btn-theme-outline" style="padding: 6px 18px; font-size: 13px;">View Details</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <div class="p-5 bg-light rounded" style="border: 2px dashed #ddd;">
            <i class="fa fa-search fa-3x text-muted mb-3"></i>
            <h3>No Job Listings Found</h3>
            <p class="text-muted">We couldn't find any jobs matching your search criteria.</p>
            <div class="mt-3">
              <a href="/jobs" class="btn-theme mr-2">View All Jobs</a>
              @if(auth()->check() && auth()->user()->isAdmin())
                <a href="/create" class="btn-theme-outline">Post a New Job</a>
              @endif
            </div>
          </div>
        </div>
      @endif
    </div>

  </div>
</div>

@endsection

