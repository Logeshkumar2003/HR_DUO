@extends('layout')

@section('title', 'Blog - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Career & Industry Blog</h1>
        <span>Insights, recruitment tips, and employment trends</span>
      </div>
    </div>
  </div>
</div>

<div class="single-services py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <section class='tabs-content'>
          <article class="mb-5 pb-4 border-bottom">
            <img src="{{ asset('assets/images/blog-image-1-940x460.jpg') }}" alt="Blog 1" class="img-fluid rounded mb-3">
            <h3><a href="/blog-details" class="text-dark font-weight-bold">Top In-Demand Skills for Modern Tech Jobs</a></h3>
            <div class="text-muted mb-2">
              <small><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i> Recent &nbsp;|&nbsp; <i class="fa fa-comments"></i> 12 comments</small>
            </div>
            <p>Discover which programming languages, cloud frameworks, and design patterns employers are prioritizing this year. Learn how staying adaptable boosts your employability in competitive markets.</p>
            <div class="mt-3">
              <a href="/blog-details" class="filled-button">Continue Reading</a>
            </div>
          </article>

          <article class="mb-5 pb-4 border-bottom">
            <img src="{{ asset('assets/images/blog-image-2-940x460.jpg') }}" alt="Blog 2" class="img-fluid rounded mb-3">
            <h3><a href="/blog-details" class="text-dark font-weight-bold">How to Stand Out in Your Next Job Interview</a></h3>
            <div class="text-muted mb-2">
              <small><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i> Recent &nbsp;|&nbsp; <i class="fa fa-comments"></i> 8 comments</small>
            </div>
            <p>Preparation, concise storytelling, and demonstrating genuine curiosity are essential components of passing both technical screens and behavioral interviews.</p>
            <div class="mt-3">
              <a href="/blog-details" class="filled-button">Continue Reading</a>
            </div>
          </article>

          <article class="mb-4">
            <img src="{{ asset('assets/images/blog-image-3-940x460.jpg') }}" alt="Blog 3" class="img-fluid rounded mb-3">
            <h3><a href="/blog-details" class="text-dark font-weight-bold">Why Remote Work Is Transforming the Global Workforce</a></h3>
            <div class="text-muted mb-2">
              <small><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i> Recent &nbsp;|&nbsp; <i class="fa fa-comments"></i> 19 comments</small>
            </div>
            <p>Remote opportunities empower companies to hire borderless talent and grant professionals unprecedented flexibility to build their dream careers from anywhere.</p>
            <div class="mt-3">
              <a href="/blog-details" class="filled-button">Continue Reading</a>
            </div>
          </article>
        </section>
      </div>

      <div class="col-md-4">
        <div class="p-4 bg-light rounded mb-4">
          <h4 class="mb-3 font-weight-bold" style="color: #232323;">Search Articles</h4>
          <form method="GET" action="/blog">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search keywords...">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <div class="p-4 bg-light rounded">
          <h4 class="mb-3 font-weight-bold" style="color: #232323;">Recent Articles</h4>
          <ul class="list-unstyled">
            <li class="mb-3 pb-2 border-bottom">
              <a href="/blog-details" class="font-weight-bold text-dark">5 Negotiation Tactics for Senior Roles</a>
              <div><small class="text-muted"><i class="fa fa-calendar"></i> Recent</small></div>
            </li>
            <li class="mb-3 pb-2 border-bottom">
              <a href="/blog-details" class="font-weight-bold text-dark">Building a Portfolio that Catches Hiring Eyes</a>
              <div><small class="text-muted"><i class="fa fa-calendar"></i> Recent</small></div>
            </li>
            <li class="mb-2">
              <a href="/blog-details" class="font-weight-bold text-dark">Navigating Career Transitions into Tech</a>
              <div><small class="text-muted"><i class="fa fa-calendar"></i> Recent</small></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

