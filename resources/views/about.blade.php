@extends('layout')

@section('title', 'About Us - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>About Us</h1>
        <span>We have over 5 years of recruitment experience</span>
      </div>
    </div>
  </div>
</div>

<div class="more-info about-info">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="more-info-content">
          <div class="row">
            <div class="col-md-6 align-self-center">
              <div class="right-content">
                <span>Who We Are</span>
                <h2>Get to know about <em>The HR Duo</em></h2>
                <p>We are dedicated to revolutionizing the job search and hiring experience. Our platform connects skilled professionals with top-tier organizations seeking exceptional talent across multiple industries and domains.</p>
                <br>
                <p>Whether you are searching for your first internship, transitioning into engineering, or scaling your company's workforce, we provide the tools, guidance, and network to ensure lasting success.</p>
                <div class="mt-4">
                  <a href="/jobs" class="filled-button mr-2">Explore Jobs</a>
                  <a href="/contact" class="border-button" style="border-color: #a4c639; color: #a4c639;">Contact Us</a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="left-image">
                <img src="{{ asset('assets/images/about-1-570x350.jpg') }}" alt="About our agency" class="img-fluid rounded">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fun-facts">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="left-content">
          <span>Proven Track Record</span>
          <h2>Empowering candidates and <em>companies worldwide</em></h2>
          <p>Our comprehensive placement process and community-driven approach ensure that every applicant finds a role aligned with their skills and values.</p>
          <br>
          <p>From initial job posting to final interview scheduling, we make every step seamless, efficient, and transparent.</p>
        </div>
      </div>
      <div class="col-md-6 align-self-center">
        <div class="row">
          <div class="col-md-6">
            <div class="count-area-content">
              <div class="count-digit">1,250+</div>
              <div class="count-title">Jobs Posted</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="count-area-content">
              <div class="count-digit">2,500+</div>
              <div class="count-title">Happy Clients</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="count-area-content">
              <div class="count-digit">200+</div>
              <div class="count-title">Referals</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="count-area-content">
              <div class="count-digit">98%</div>
              <div class="count-title">Satisfaction</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

