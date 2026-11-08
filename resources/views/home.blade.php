@extends('layout')

@section('title', 'The HR Duo - Home')

@section('content')

<!-- Banner Starts Here -->
<div class="main-banner header-text" id="top">
    <div class="Modern-Slider">
      <!-- Item 1 -->
      <div class="item item-1">
        <div class="img-fill">
            <div class="text-content">
              <h6>Find Your Perfect Career</h6>
              <h4>Connecting Talent <br> With Opportunity</h4>
              <p>Explore thousands of verified job listings across top companies and industries. Take the next step in your professional journey today.</p>
              <a href="/jobs" class="filled-button">Explore Jobs</a>
            </div>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="item item-2">
        <div class="img-fill">
            <div class="text-content">
              <h6>Trusted Job Solutions</h6>
              <h4>Empowering Candidates <br> Worldwide</h4>
              <p>With years of recruitment experience, we bridge the gap between passionate job seekers and industry-leading employers.</p>
              <a href="/about" class="filled-button">About Us</a>
            </div>
        </div>
      </div>
      <!-- Item 3 -->
      <div class="item item-3">
        <div class="img-fill">
            <div class="text-content">
              <h6>Need Assistance?</h6>
              <h4>We Are Here <br> To Support You</h4>
              <p>Have questions about next job or applying? Get in touch with our expert advisory team for personalized guidance.</p>
              <a href="/contact" class="filled-button">Contact Us</a>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Banner Ends Here -->

<div class="request-form">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h4>Looking to hire top MNC or find your next role?</h4>
        <span>Reach out to our specialists today and let us help you achieve your goals.</span>
      </div>
      <div class="col-md-4">
        <a href="/contact" class="border-button">Contact Us</a>
      </div>
    </div>
  </div>
</div>

<!-- Featured Jobs Section (Dynamic from Database) -->
<div class="services py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Featured <em>Jobs</em></h2>
          <span>Explore the latest verified opportunities from our database</span>
        </div>
      </div>

      @if(isset($featuredJobs) && count($featuredJobs) > 0)
        @foreach($featuredJobs as $job)
          <div class="col-lg-4 col-md-6 col-12 mb-4 d-flex align-items-stretch">
            <div class="job-listing-card w-100">
              <div>
                <div class="job-card-header">
                  <a href="/listings/{{ $job->id }}">
                    <img src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('img/nologo.jpg') }}" alt="{{ $job->company }} logo" class="job-card-logo">
                  </a>
                  <div class="flex-grow-1">
                    <h4 class="job-card-title">
                      <a href="/listings/{{ $job->id }}">{{ $job->title }}</a>
                    </h4>
                    <div class="job-card-company">{{ $job->company }}</div>
                    <div class="job-card-location">
                      <i class="fa fa-map-marker"></i> {{ $job->location }}
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <x-listing-tags :tags="$job->tags" />
                </div>

                <div class="job-card-description">
                  {{ \Illuminate\Support\Str::limit($job->description, 110) }}
                </div>
              </div>

              <div class="job-card-footer">
                <small class="text-muted"><i class="fa fa-clock-o mr-1"></i> {{ $job->created_at ? $job->created_at->diffForHumans() : 'Recently' }}</small>
                <a href="/listings/{{ $job->id }}" class="btn-theme-outline" style="padding: 5px 16px; font-size: 13px;">View Details</a>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center py-4">
          <p class="text-muted">No featured jobs available right now.</p>
        </div>
      @endif

      <div class="col-12 text-center mt-4">
        <a href="/jobs" class="filled-button mr-2">Browse All Jobs</a>
        @if(auth()->check() && auth()->user()->isAdmin())
          <a href="/create" class="border-button" style="border-color: #a4c639; color: #a4c639;">Post a Job</a>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="fun-facts">
  <div class="container">
    <div class="more-info-content">
      <div class="row">
        <div class="col-md-6">
          <div class="left-image">
            <img src="{{ asset('assets/images/about-1-570x350.jpg') }}" class="img-fluid" alt="About our agency">
          </div>
        </div>
        <div class="col-md-6 align-self-center">
          <div class="right-content">
            <span>Who we are</span>
            <h2>Get to know about <em>The HR Duo</em></h2>
            <p>The HR Duo was founded by two passionate HR professionals with a vision to simplify recruitment, empower job seekers and connect organisations with right talent. With experience in Talent Acquisition, HR Operations, Employee Relations and the complete Hire-to-Retire lifecycle, we bring practical industry insights to individuals and businesses.</p>
            <a href="/about" class="filled-button">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="more-info">
  <div class="container">
    <div class="section-heading">
      <h2>Read our <em>Blog</em></h2>
      <span>Insights, recruitment tips, and industry trends</span>
    </div>

    <div class="row" id="tabs">
      <div class="col-md-4">
        <ul>
          <li><a href='#tabs-1'>Top In-Demand Skills for Modern Tech Jobs <br> <small>Admin &nbsp;|&nbsp; Recent</small></a></li>
          <li><a href='#tabs-2'>How to Stand Out in Your Next Job Interview <br> <small>Admin &nbsp;|&nbsp; Recent</small></a></li>
          <li><a href='#tabs-3'>Why Remote Work Is Transforming the Global Workforce <br> <small>Admin &nbsp;|&nbsp; Recent</small></a></li>
        </ul>

        <div class="text-center mt-4">
          <a href="/blog" class="filled-button">All Blog Posts</a>
        </div>
      </div>

      <div class="col-md-8">
        <section class='tabs-content'>
          <article id='tabs-1'>
            <img src="{{ asset('assets/images/blog-image-1-940x460.jpg') }}" alt="Blog 1">
            <h4><a href="/blog-details">Top In-Demand Skills for Modern Tech Jobs</a></h4>
            <p>Discover which programming languages, cloud platforms, and architecture patterns employers are prioritizing this year. Learn how staying adaptable boosts your employability in competitive markets.</p>
          </article>
          <article id='tabs-2'>
            <img src="{{ asset('assets/images/blog-image-2-940x460.jpg') }}" alt="Blog 2">
            <h4><a href="/blog-details">How to Stand Out in Your Next Job Interview</a></h4>
            <p>Preparation, concise storytelling, and demonstrating genuine domain curiosity are essential components of passing both technical screens and behavioral interviews.</p>
          </article>
          <article id='tabs-3'>
            <img src="{{ asset('assets/images/blog-image-3-940x460.jpg') }}" alt="Blog 3">
            <h4><a href="/blog-details">Why Remote Work Is Transforming the Global Workforce</a></h4>
            <p>Remote opportunities empower companies to hire borderless talent and grant professionals unprecedented flexibility to build their dream careers from anywhere.</p>
          </article>
        </section>
      </div>
    </div>
  </div>
</div>

<div class="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>What they say <em>about us</em></h2>
          <span>Testimonials from our clients and candidates</span>
        </div>
      </div>
      <div class="col-md-12">
        <div class="owl-testimonials owl-carousel">
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Ganesh Shetty</h4>
              <span>Business Financial Analyst</span>
              <p>"Within two weeks of uploading my resume, I was shortlisted and interviewed by a premier financial firm. The guidance throughout the entire process was swift, professional, and transparent."</p>
            </div>
          </div>
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Yatika Simran</h4>
              <span>Senior Software Engineer</span>
              <p>"Finding specialized engineering roles with competitive compensation has never been simpler. The mock interview sessions and ATS resume prep gave me immense confidence during hiring rounds."</p>
            </div>
          </div>
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Ram Kumar</h4>
              <span>Support Engineering</span>
              <p>"We filled three critical engineering vacancies with exceptional talent within a single hiring cycle. The candidates were thoroughly pre-screened and exceeded our technical standards."</p>
            </div>
          </div>
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Dharshna Sripal</h4>
              <span>Product Support</span>
              <p>"The 1:1 advisory sessions and curated job recommendations saved me countless hours of manual search. I secured a leadership role at a top-tier tech firm in under a month."</p>
            </div>
          </div>
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Sarah Asha </h4>
              <span>Senior Cloud Architect</span>
              <p>"The personalized resume customization and industry mentor pairing were game changers. I cleared all technical rounds seamlessly and received a competitive offer package."</p>
            </div>
          </div>
          
          <div class="testimonial-item">
            <div class="inner-content">
              <h4>Nirmal Kumar</h4>
              <span>Junior Talent Acquisition</span>
              <p>"Partnering with this recruitment advisory transformed our corporate hiring speed. Their deep understanding of enterprise requirements consistently delivers shortlist-ready talent."</p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="callback-form career-services-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12 text-center">
        <div class="section-heading text-center">
          <h2>Our Exclusive <em>Career Services</em></h2>
          <span>Accelerate your job search with personalized guidance</span>
        </div>
      </div>
      <div class="col-lg-10 col-md-12">
        <div class="contact-form text-center p-5" style="background-color: #232323; border-radius: 8px; border-top: 4px solid #a4c639;">
          <h3 class="text-white font-weight-bold mb-3">Book Mock Interviews, 1:1 Sessions &amp; Resume Customization</h3>
          <p class="text-light mb-4" style="max-width: 700px; margin: 0 auto; font-size: 15px;">
            Get paired with seasoned industry mentors. Choose an exclusive service, upload your resume, and connect with our team today.
          </p>
          <a href="/contact#contact-section" class="filled-button" style="padding: 14px 35px; font-size: 14px; text-transform: uppercase;">
            <i class="fa fa-file-text-o mr-2"></i> Book Exclusive Service &amp; Upload Resume
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

