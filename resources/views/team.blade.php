@extends('layout')

@section('title', 'Our Team - The HR Duo')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Our Team</h1>
        <span>Meet our dedicated talent acquisition specialists</span>
      </div>
    </div>
  </div>
</div>

<div class="team py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="section-heading text-center">
          <h2>Our Leadership <em>Team</em></h2>
          <span>Experienced HR insiders and recruitment champions dedicated to your career success</span>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- Founder Card -->
      <div class="col-lg-5 col-md-6 col-12 mb-4 d-flex align-items-stretch">
        <div class="team-profile-card w-100" data-toggle="modal" data-target="#founderModal" role="button" tabindex="0">
          <div class="profile-card-header">
            <span class="role-badge">Founder</span>
            <h3 class="profile-name">Prasanthi Nitta</h3>
            <p class="profile-tagline">“Corporate HR insider. Job seeker’s biggest backer.”</p>
          </div>
          <div class="profile-card-footer">
            <span class="view-profile-cta">
              View Complete Profile <i class="fa fa-arrow-circle-right ml-1"></i>
            </span>
          </div>
        </div>
      </div>

      <!-- Co-Founder Card -->
      <div class="col-lg-5 col-md-6 col-12 mb-4 d-flex align-items-stretch">
        <div class="team-profile-card w-100" data-toggle="modal" data-target="#coFounderModal" role="button" tabindex="0">
          <div class="profile-card-header">
            <span class="role-badge">Co-Founder</span>
            <h3 class="profile-name">Likhitha Kalla</h3>
            <p class="profile-tagline">“Recruiter’s eye. Candidate’s advocate.”</p>
          </div>
          <div class="profile-card-footer">
            <span class="view-profile-cta">
              View Complete Profile <i class="fa fa-arrow-circle-right ml-1"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Founder Modal (Prasanthi Nitta) -->
<div class="modal fade" id="founderModal" tabindex="-1" role="dialog" aria-labelledby="founderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content profile-modal-content">
      <div class="modal-header profile-modal-header d-flex justify-content-between align-items-start">
        <div>
          <span class="role-badge mb-2">Founder</span>
          <h3 class="modal-title font-weight-bold" id="founderModalLabel" style="color: #232323; font-size: 26px;">Prasanthi Nitta</h3>
          <p class="profile-modal-tagline mb-0" style="color: #666; font-style: italic; font-size: 15px;">“Corporate HR insider. Job seeker’s biggest backer.”</p>
        </div>
        <button type="button" class="close profile-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body profile-modal-body">
        <div class="profile-section mb-4">
          <h5 class="profile-section-title"><i class="fa fa-user mr-2 text-theme"></i>Professional Profile</h5>
          <p>Prasanthi has spent 5 years inside some of the world’s most recognised organisations: <strong>Accenture, Wipro and OGS</strong>. She currently drives HR Operations at Accenture, holds a Master’s in Human Resource Management, and has worked across the full Hire-to-Retire lifecycle, including HR Operations, Employee Relations, Sourcing, Screening, Onboarding and Background Verification.</p>
          <p>She has sat on the hiring side of the table, so she knows what recruiters look for, how shortlisting decisions are made, and what separates a candidate who gets the offer from one who doesn’t. Her mission is simple: <strong>get job seekers placed</strong>.</p>
        </div>

        <div class="profile-section mb-4">
          <h5 class="profile-section-title"><i class="fa fa-bullseye mr-2 text-theme"></i>Focus Areas</h5>
          <ul class="profile-focus-list">
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Resumes that clear ATS and impress HR, so you get shortlisted.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Preparation for HR, technical and managerial rounds.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Confidence and communication that show in the room.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Guidance all the way to the final offer.</li>
          </ul>
        </div>

        <div class="profile-highlight-box mb-4">
          <div class="d-flex align-items-center">
            <div class="highlight-icon mr-3">
              <i class="fa fa-trophy"></i>
            </div>
            <div>
              <h6 class="mb-1 font-weight-bold" style="color: #232323;">Key Achievement</h6>
              <p class="mb-0 text-muted font-weight-500"><strong>300+ candidates</strong> guided through every interview round, all the way to the offer letter.</p>
            </div>
          </div>
        </div>

        <div class="profile-section mb-4">
          <h5 class="profile-section-title"><i class="fa fa-building mr-2 text-theme"></i>Companies Where Candidates Have Been Placed</h5>
          <div class="company-chips">
            <span class="company-chip">Accenture</span>
            <span class="company-chip">Tech Mahindra</span>
            <span class="company-chip">Infosys</span>
            <span class="company-chip">TCS</span>
            <span class="company-chip">HighRadius</span>
            <span class="company-chip">Deloitte</span>
            <span class="company-chip">Cognizant</span>
            <span class="company-chip">HCL Tech</span>
            <span class="company-chip">Capgemini</span>
            <span class="company-chip">&amp; more</span>
          </div>
        </div>

        <div class="profile-statement-box">
          <h6 class="statement-label"><i class="fa fa-quote-left mr-2 text-theme"></i>Personal Statement</h6>
          <p class="mb-0 statement-text">“I’ve seen what happens behind the hiring desk. My goal is to make sure every job seeker I work with is ready for it, from the first interview to the offer letter.”</p>
        </div>
      </div>
      <div class="modal-footer profile-modal-footer">
        <button type="button" class="filled-button border-0 px-4 py-2" data-dismiss="modal">Close Profile</button>
      </div>
    </div>
  </div>
</div>

<!-- Co-Founder Modal (Likhitha Kalla) -->
<div class="modal fade" id="coFounderModal" tabindex="-1" role="dialog" aria-labelledby="coFounderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content profile-modal-content">
      <div class="modal-header profile-modal-header d-flex justify-content-between align-items-start">
        <div>
          <span class="role-badge mb-2">Co-Founder</span>
          <h3 class="modal-title font-weight-bold" id="coFounderModalLabel" style="color: #232323; font-size: 26px;">Likhitha Kalla</h3>
          <p class="profile-modal-tagline mb-0" style="color: #666; font-style: italic; font-size: 15px;">“Recruiter’s eye. Candidate’s advocate.”</p>
        </div>
        <button type="button" class="close profile-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body profile-modal-body">
        <div class="profile-section mb-4">
          <h5 class="profile-section-title"><i class="fa fa-user mr-2 text-theme"></i>Professional Profile</h5>
          <p>Likhitha has 3+ years of HR experience across hospitality, manufacturing, tech recruitment and fashion retail, with stints at <strong>Radisson Blu, Brandix, Biocon Biologics and the Aditya Birla Group’s Digital Fashion business</strong>. At RiteFit AI, she handled recruitment for top clients including <strong>Tech Mahindra, EY and Deloitte</strong>.</p>
          <p>With an MBA in Human Resources and Marketing, she covers Talent Acquisition, HR Operations, Employee Relations, Employee Engagement and HR Business Partnering. She has shortlisted, screened and placed candidates for some of the biggest names in the industry, so she knows exactly what hiring managers want to see.</p>
        </div>

        <div class="profile-highlight-box mb-4">
          <div class="d-flex align-items-center">
            <div class="highlight-icon mr-3">
              <i class="fa fa-compass"></i>
            </div>
            <div>
              <h6 class="mb-1 font-weight-bold" style="color: #232323;">Her Focus</h6>
              <p class="mb-0 text-muted font-weight-500">Getting candidates <strong>interview-ready and employer-ready</strong>.</p>
            </div>
          </div>
        </div>

        <div class="profile-section mb-4">
          <h5 class="profile-section-title"><i class="fa fa-bullseye mr-2 text-theme"></i>Focus Areas</h5>
          <ul class="profile-focus-list">
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Sourcing and matching candidates to the right roles.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Presenting your profile to pass both ATS and the HR recruiter’s eye.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Navigating screening, interviews and employer expectations.</li>
            <li><i class="fa fa-check-circle mr-2 text-theme"></i>Connecting you with the right opportunities, with fresh openings posted daily.</li>
          </ul>
        </div>

        <div class="profile-statement-box">
          <h6 class="statement-label"><i class="fa fa-quote-left mr-2 text-theme"></i>Personal Statement</h6>
          <p class="mb-0 statement-text">“I’ve been on the recruiter’s side of the call. I know what gets a candidate shortlisted, and I want to help every job seeker get there.”</p>
        </div>
      </div>
      <div class="modal-footer profile-modal-footer">
        <button type="button" class="filled-button border-0 px-4 py-2" data-dismiss="modal">Close Profile</button>
      </div>
    </div>
  </div>
</div>

@endsection

