 @extends('layout')

@section('title', $listing->title . ' - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ $listing->title }}</h1>
        <span>{{ $listing->company }} &bull; {{ $listing->location }}</span>
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
      <div class="col-lg-10">
        <div class="job-detail-box">
          <div class="text-center pb-4 border-bottom">
            <img src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('img/nologo.jpg') }}" alt="{{ $listing->company }} logo" class="job-detail-logo">
            <h2 class="job-detail-title">{{ $listing->title }}</h2>
            <h5 class="text-muted mb-3 font-weight-normal">{{ $listing->company }}</h5>
            
            <div class="d-flex flex-wrap justify-content-center mb-3">
              <span class="job-meta-pill">
                <i class="fa fa-map-marker"></i> {{ $listing->location }}
              </span>
              <span class="job-meta-pill">
                <i class="fa fa-envelope"></i> {{ $listing->email }}
              </span>
              @if($listing->website)
              <span class="job-meta-pill">
                <i class="fa fa-globe"></i> <a href="{{ $listing->website }}" target="_blank" rel="noopener noreferrer" class="text-muted">{{ $listing->website }}</a>
              </span>
              @endif
            </div>

            <div class="mt-2">
              <x-listing-tags :tags="$listing->tags" />
            </div>
          </div>

          <!-- Description Section -->
          <div class="pt-4">
            <h4 class="mb-3 font-weight-bold" style="color: #232323;">Job Description</h4>
            <div class="job-description-content">
              {{ $listing->description }}
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="text-center pt-5 mt-4 border-top">
            @if($listing->application_url)
              <a href="{{ $listing->application_url }}" target="_blank" rel="noopener noreferrer" class="btn-theme btn-apply-now">
                Apply Now <i class="fa fa-external-link ml-2"></i>
              </a>
            @else
              <button type="button" class="btn-theme btn-apply-now disabled" disabled>
                Apply Now
              </button>
            @endif

            @auth
            @if(auth()->user()->isAdmin())
            <div class="mt-4 pt-3 border-top">
              <span class="text-muted mr-3"><i class="fa fa-shield mr-1"></i> Admin Actions:</span>
              <a href="/listings/{{ $listing->id }}/edit" class="btn-theme-outline mr-2">
                <i class="fa fa-pencil mr-1"></i> Edit Listing
              </a>
              <form method="POST" action="/listings/{{ $listing->id }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-theme-danger">
                  <i class="fa fa-trash mr-1"></i> Delete Listing
                </button>
              </form>
            </div>
            @endif
            @endauth
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

@endsection
