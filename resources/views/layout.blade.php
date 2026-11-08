<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Job Agency Website">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>@yield('title', 'The HR Duo')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jobs-integrated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive-refinement.css') }}">
    
    @yield('extra-css')
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <div class="sub-header">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <ul class="left-info">
              <li><a href="#"><i class="fa fa-envelope"></i>hrduo11@gmail.com</a></li>
              <li><a href="#"><i class="fa fa-phone"></i>+91 8688-540-127</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="right-icons">
              <li><a href="https://www.instagram.com/the.hr_duo"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="/"><h2>The <em> HR DUO</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto align-items-lg-center">
              <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">Home</a>
              </li>
              <li class="nav-item {{ Request::is('jobs*') || Request::is('listings*') ? 'active' : '' }}">
                <a class="nav-link" href="/jobs">Jobs</a>
              </li>
              <li class="nav-item dropdown {{ Request::is('about*') || Request::is('team*') || Request::is('blog*') || Request::is('testimonials*') || Request::is('terms*') ? 'active' : '' }}">
                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>
              
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/about">About Us</a>
                    <a class="dropdown-item" href="/team">Team</a>
                    <a class="dropdown-item" href="/blog">Blog</a>
                    <a class="dropdown-item" href="/testimonials">Testimonials</a>
                    <a class="dropdown-item" href="/terms">Terms</a>
                </div>
              </li>
              <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}">
                <a class="nav-link" href="/contact">Contact Us</a>
              </li>

              @auth
              @if(auth()->user()->isAdmin())
              <li class="nav-item {{ Request::is('manage*') ? 'active' : '' }}">
                <a class="nav-link" href="/manage"><i class="fa fa-briefcase"></i> Dashboard</a>
              </li>
              @if(auth()->user()->isMainAdmin())
              <li class="nav-item {{ Request::is('admin/access*') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/access"><i class="fa fa-users-cog"></i> Access Control</a>
              </li>
              @endif
              <li class="nav-item ml-lg-2">
                <a class="btn btn-sm" href="/create" style="border-radius: 20px; padding: 7px 18px; font-weight: 700; background-color: #a4c639; color: #fff;"><i class="fa fa-plus-circle"></i> Post a Job</a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i> Logout ({{ auth()->user()->name }})</a>
              </li>
              @else
              <li class="nav-item {{ Request::is('login*') ? 'active' : '' }}">
                <a class="nav-link" href="/login"><i class="fa fa-lock"></i> Admin Login</a>
              </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>
    </header>



    @yield('content')

    <!-- Footer Starts Here -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 footer-item">
            <h4>The HR Duo</h4>
            <p>Connecting exceptional talent with premier companies worldwide through modern recruitment solutions.</p>
            <ul class="social-icons">
              <li><a href="https://www.instagram.com/the.hr_duo"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 footer-item">
            <h4>Useful Links</h4>
            <ul class="menu-list">
              <li><a href="/">Home</a></li>
              <li><a href="/jobs">Jobs</a></li>
              <li><a href="/login">Admin Portal</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 footer-item">
            <h4>Additional Pages</h4>
            <ul class="menu-list">
              <li><a href="/about">About Us</a></li>
              <li><a href="/team">Our Team</a></li>
              <li><a href="/blog">Blog</a></li>
              <li><a href="/testimonials">Testimonials</a></li>
              <li><a href="/terms">Terms</a></li>
              <li><a href="/contact">Contact Us</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-12 footer-item last-item">
            <h4>Exclusive Services</h4>
            <p style="color: #aaa; font-size: 13px; line-height: 22px;">
              Looking for Mock Interview Sessions, Resume Customization, or 1:1 Career Guidance?
            </p>
            <div class="mt-3">
              <a href="/contact#contact-section" class="filled-button" style="display: block; text-align: center; font-size: 12px; padding: 10px 15px;">
                <i class="fa fa-envelope mr-1"></i> Contact HR Team
              </a>
            </div>
            <div class="mt-3 small" style="color: #888;">
              <i class="fa fa-envelope mr-1" style="color: #a4c639;"></i> hrduo11@gmail.com
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>
                Copyright © 2026 The HR Duo Website
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>

    @yield('extra-js')

  </body>
</html>
