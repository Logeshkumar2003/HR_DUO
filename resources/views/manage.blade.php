@extends('layout')

@section('title', 'Manage Job Postings - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Administrator Dashboard</h1>
        <span>Manage job postings, updates, and candidate applications</span>
      </div>
    </div>
  </div>
</div>

<div class="services py-5">
  <div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
      <div>
        <h3 class="font-weight-bold mb-1" style="color: #232323;">Job Postings Management</h3>
        <span class="badge {{ auth()->user()->isMainAdmin() ? 'badge-success' : 'badge-info' }} px-3 py-1" style="font-size: 13px;">
          <i class="fa {{ auth()->user()->isMainAdmin() ? 'fa-shield' : 'fa-user' }} mr-1"></i>
          {{ auth()->user()->isMainAdmin() ? 'Main Administrator' : 'Secondary Administrator' }}: {{ auth()->user()->name }}
        </span>
      </div>
      <div class="mt-2 mt-md-0">
        @if(auth()->user()->isMainAdmin())
          <a href="/admin/access" class="btn-theme mr-2" style="padding: 10px 22px; font-size: 13px; background-color: #232323;">
            <i class="fa fa-users-cog mr-1"></i> Admin Access Management
          </a>
        @endif
        <a href="/create" class="btn-theme" style="padding: 10px 22px; font-size: 13px;">
          <i class="fa fa-plus-circle mr-1"></i> Post a New Job
        </a>
      </div>
    </div>

    @if(count($listings) > 0)
      <div class="table-responsive bg-white rounded shadow-sm border p-3">
        <table class="table table-hover align-middle mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 70px;">Logo</th>
              <th scope="col">Job Title & Company</th>
              <th scope="col">Location</th>
              <th scope="col">Application URL</th>
              <th scope="col">Date Posted</th>
              <th scope="col" class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listings as $listing)
              <tr>
                <td>
                  <img src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('img/nologo.jpg') }}" alt="logo" style="width: 50px; height: 50px; object-fit: contain; border-radius: 8px; border: 1px solid #eee; padding: 2px;">
                </td>
                <td>
                  <a href="/listings/{{ $listing->id }}" class="font-weight-bold text-dark" style="font-size: 16px;">
                    {{ $listing->title }}
                  </a>
                  <div class="text-muted small">{{ $listing->company }}</div>
                </td>
                <td>
                  <i class="fa fa-map-marker text-muted mr-1"></i> {{ $listing->location }}
                </td>
                <td>
                  @if($listing->application_url)
                    <a href="{{ $listing->application_url }}" target="_blank" rel="noopener noreferrer" class="badge badge-light border px-2 py-1 text-truncate d-inline-block" style="max-width: 200px; color: #a4c639; font-size: 12px;" title="{{ $listing->application_url }}">
                      <i class="fa fa-external-link mr-1"></i> {{ $listing->application_url }}
                    </a>
                  @else
                    <span class="text-muted small">Not set</span>
                  @endif
                </td>
                <td>
                  <small class="text-muted">{{ $listing->created_at ? $listing->created_at->format('M d, Y') : 'N/A' }}</small>
                </td>
                <td class="text-right">
                  <a href="/listings/{{ $listing->id }}" class="btn btn-sm btn-outline-info mr-1" title="View Listing">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <a href="/listings/{{ $listing->id }}/edit" class="btn btn-sm btn-outline-primary mr-1" title="Edit Listing">
                    <i class="fa fa-pencil"></i> Edit
                  </a>
                  <form method="POST" action="/listings/{{ $listing->id }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Listing">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="text-center py-5 bg-light rounded border">
        <i class="fa fa-briefcase fa-3x text-muted mb-3"></i>
        <h4>No Listings Found</h4>
        <p class="text-muted">No job postings have been created yet.</p>
        <div class="mt-3">
          <a href="/create" class="btn-theme">Post the First Job</a>
        </div>
      </div>
    @endif

  </div>
</div>

@endsection
