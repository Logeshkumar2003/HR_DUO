@extends('layout')

@section('title', 'Contact Us - Exclusive Career Services')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Contact Us</h1>
        <span>Get in touch with our career advisory and recruitment team</span>
      </div>
    </div>
  </div>
</div>

<div class="contact-information py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-6 col-12 mb-4">
        <div class="contact-item">
          <div class="contact-icon-wrapper">
            <i class="fa fa-phone"></i>
          </div>
          <h4>Direct Support</h4>
          <p>Questions about mock interviews, resume customization, or 1:1 sessions?</p>
          <a href="tel:+133340405566">+91 8688-540-127</a>
        </div>
      </div>
      <div class="col-lg-5 col-md-6 col-12 mb-4">
        <div class="contact-item">
          <div class="contact-icon-wrapper">
            <i class="fa fa-envelope"></i>
          </div>
          <h4>HR & Inquiries</h4>
          <p>All candidate submissions &amp; resumes are delivered to our HR team.</p>
          <a href="mailto:hrduo11@gmail.com">hrduo11@gmail.com</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="contact-section" class="callback-form contact-us py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Send us a <em>message</em></h2>
          <span>Book an exclusive service or reach out with your resume</span>
        </div>
      </div>

      <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="bg-white rounded p-4 p-md-5 shadow-sm border">

          <!-- Inline Feedback Area (No browser alerts or popup windows) -->
          <div id="contact-inline-feedback" class="mb-4" style="display: none;"></div>

          @if(session('contact_success'))
            <div class="mb-4 p-3 rounded" style="background-color: #f3f9ec; border-left: 4px solid #a4c639; color: #3c763d; font-size: 15px;">
              <i class="fa fa-check-circle mr-2"></i> {{ session('contact_success') }}
            </div>
          @endif

          @if(session('contact_error'))
            <div class="mb-4 p-3 rounded" style="background-color: #fdf0f0; border-left: 4px solid #d9534f; color: #a94442; font-size: 14px;">
              <i class="fa fa-exclamation-triangle mr-2"></i> {{ session('contact_error') }}
            </div>
          @endif

          @if($errors->any())
            <div class="mb-4 p-3 rounded" style="background-color: #fdf0f0; border-left: 4px solid #d9534f; color: #a94442; font-size: 14px;">
              <strong class="d-block mb-1"><i class="fa fa-exclamation-triangle mr-2"></i> Please correct the following:</strong>
              <ul class="mb-0 pl-3">
                @foreach($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="contactForm" action="/contact" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row">
              <!-- Name Input -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Full Name <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;">
                      <i class="fa fa-user text-muted"></i>
                    </span>
                  </div>
                  <input type="text" 
                         name="name" 
                         id="name" 
                         class="form-control border-left-0 @error('name') is-invalid @enderror" 
                         placeholder="e.g. Alex Morgan" 
                         value="{{ old('name') }}" 
                         required 
                         style="border-radius: 0 8px 8px 0; height: 46px;" />
                </div>
                <small class="text-danger font-weight-bold field-error" id="name-error">
                  @error('name') {{ $message }} @enderror
                </small>
              </div>

              <!-- Contact Number Input -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="phone" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Contact Number <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;">
                      <i class="fa fa-phone text-muted"></i>
                    </span>
                  </div>
                  <input type="tel" 
                         name="phone" 
                         id="phone" 
                         class="form-control border-left-0 @error('phone') is-invalid @enderror" 
                         placeholder="e.g. +1 555 123 4567" 
                         value="{{ old('phone') }}" 
                         required 
                         style="border-radius: 0 8px 8px 0; height: 46px;" />
                </div>
                <small class="text-danger font-weight-bold field-error" id="phone-error">
                  @error('phone') {{ $message }} @enderror
                </small>
              </div>

              <!-- Email Address Input -->
              <div class="col-lg-4 col-md-12 col-12 mb-3">
                <label for="email" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Email Address <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;">
                      <i class="fa fa-envelope text-muted"></i>
                    </span>
                  </div>
                  <input type="email" 
                         name="email" 
                         id="email" 
                         class="form-control border-left-0 @error('email') is-invalid @enderror" 
                         placeholder="alex@example.com" 
                         value="{{ old('email') }}" 
                         required 
                         style="border-radius: 0 8px 8px 0; height: 46px;" />
                </div>
                <small class="text-danger font-weight-bold field-error" id="email-error">
                  @error('email') {{ $message }} @enderror
                </small>
              </div>

              <!-- Choose Our Exclusive Service Dropdown -->
              <div class="col-lg-6 col-md-12 col-12 mb-3">
                <label for="service" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Choose Our Exclusive Service <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;">
                      <i class="fa fa-briefcase text-muted"></i>
                    </span>
                  </div>
                  <select name="service" 
                          id="service" 
                          class="form-control border-left-0 custom-select @error('service') is-invalid @enderror" 
                          required 
                          style="border-radius: 0 8px 8px 0; height: 46px; font-size: 14px;">
                    <option value="" disabled {{ old('service') ? '' : 'selected' }}>-- Select an Exclusive Service --</option>
                    <option value="Book Mock Interview Session" {{ old('service') == 'Book Mock Interview Session' ? 'selected' : '' }}>
                      Book Mock Interview Session
                    </option>
                    <option value="Customise Your Resume" {{ old('service') == 'Customise Your Resume' ? 'selected' : '' }}>
                      Customise Your Resume
                    </option>
                    <option value="Book Your 1:1 Sessions" {{ old('service') == 'Book Your 1:1 Sessions' ? 'selected' : '' }}>
                      Book Your 1:1 Sessions
                    </option>
                  </select>
                </div>
                <small class="text-danger font-weight-bold field-error" id="service-error">
                  @error('service') {{ $message }} @enderror
                </small>
              </div>

              <!-- Upload Your Resume Input -->
              <div class="col-lg-6 col-md-12 col-12 mb-3">
                <label for="resume" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Upload Your Resume <span class="text-danger">*</span>
                  <span class="text-muted font-weight-normal small">(PDF, DOC, DOCX &le; 10MB)</span>
                </label>
                <div class="custom-file" style="height: 46px;">
                  <input type="file" 
                         name="resume" 
                         id="resume" 
                         class="custom-file-input @error('resume') is-invalid @enderror" 
                         accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" 
                         required 
                         style="height: 46px; cursor: pointer;" />
                  <label class="custom-file-label d-flex align-items-center text-truncate" for="resume" id="resume-label" style="height: 46px; border-radius: 8px; color: #6a6a6a; padding-right: 90px;">
                    <i class="fa fa-cloud-upload mr-2 text-muted"></i> Choose PDF, DOC, or DOCX...
                  </label>
                </div>
                <small class="text-danger font-weight-bold field-error" id="resume-error">
                  @error('resume') {{ $message }} @enderror
                </small>
              </div>

              <!-- Your Message Multiline Textarea -->
              <div class="col-12 mb-4">
                <label for="message" class="font-weight-bold text-dark" style="font-size: 14px;">
                  Your Message <span class="text-danger">*</span>
                </label>
                <textarea name="message" 
                          id="message" 
                          rows="5" 
                          class="form-control @error('message') is-invalid @enderror" 
                          placeholder="Tell us about your career goals, specific targets, or questions about the selected service..." 
                          required 
                          style="border-radius: 8px; padding: 14px; font-size: 14px; border: 1px solid #ced4da;">{{ old('message') }}</textarea>
                <small class="text-danger font-weight-bold field-error" id="message-error">
                  @error('message') {{ $message }} @enderror
                </small>
              </div>

              <!-- Submit Button -->
              <div class="col-12 text-center">
                <button type="submit" 
                        id="form-submit-btn" 
                        class="filled-button" 
                        style="padding: 13px 40px; font-size: 14px; letter-spacing: 0.5px; border-radius: 30px;">
                  <i class="fa fa-paper-plane mr-2"></i> Send Message
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<div id="map">
  <iframe src="https://maps.google.com/maps?q=New+York+City&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<!-- Inline JavaScript for Form Validation & Duplicate Submission Prevention (No Popups / No Alerts) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const fileInput = document.getElementById('resume');
  const fileLabel = document.getElementById('resume-label');
  const submitBtn = document.getElementById('form-submit-btn');
  const feedbackBox = document.getElementById('contact-inline-feedback');

  if (!form) return;

  // Update file input label dynamically when a file is chosen
  fileInput.addEventListener('change', function () {
    if (this.files && this.files.length > 0) {
      const file = this.files[0];
      fileLabel.innerHTML = '<i class="fa fa-file-text-o mr-2 text-success"></i> ' + escapeHtml(file.name);
      fileLabel.style.color = '#232323';
      clearFieldError('resume');
    } else {
      fileLabel.innerHTML = '<i class="fa fa-cloud-upload mr-2 text-muted"></i> Choose PDF, DOC, or DOCX...';
      fileLabel.style.color = '#6a6a6a';
    }
  });

  // Clear errors on input
  ['name', 'phone', 'email', 'service', 'message'].forEach(function (id) {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener('input', function () {
        clearFieldError(id);
      });
      el.addEventListener('change', function () {
        clearFieldError(id);
      });
    }
  });

  function clearFieldError(fieldId) {
    const errEl = document.getElementById(fieldId + '-error');
    if (errEl) errEl.innerText = '';
    const inputEl = document.getElementById(fieldId);
    if (inputEl) inputEl.classList.remove('is-invalid');
  }

  function setFieldError(fieldId, message) {
    const errEl = document.getElementById(fieldId + '-error');
    if (errEl) errEl.innerText = message;
    const inputEl = document.getElementById(fieldId);
    if (inputEl) inputEl.classList.add('is-invalid');
  }

  function showInlineMessage(type, message, list) {
    feedbackBox.style.display = 'block';
    if (type === 'success') {
      feedbackBox.innerHTML = `
        <div class="p-3 rounded" style="background-color: #f3f9ec; border-left: 4px solid #a4c639; color: #2e6930; font-size: 15px;">
          <i class="fa fa-check-circle mr-2" style="font-size: 18px; vertical-align: middle;"></i>
          <strong>Success!</strong> ${escapeHtml(message)}
        </div>
      `;
    } else if (type === 'warning') {
      feedbackBox.innerHTML = `
        <div class="p-3 rounded" style="background-color: #fff9e6; border-left: 4px solid #f0ad4e; color: #8a6d3b; font-size: 14px;">
          <i class="fa fa-info-circle mr-2" style="font-size: 18px; vertical-align: middle;"></i>
          <strong>Notice:</strong> ${escapeHtml(message)}
        </div>
      `;
    } else {
      let listHtml = '';
      if (list && list.length > 0) {
        listHtml = '<ul class="mb-0 mt-2 pl-3">' + list.map(item => `<li>${escapeHtml(item)}</li>`).join('') + '</ul>';
      }
      feedbackBox.innerHTML = `
        <div class="p-3 rounded" style="background-color: #fdf0f0; border-left: 4px solid #d9534f; color: #a94442; font-size: 14px;">
          <i class="fa fa-exclamation-triangle mr-2"></i>
          <strong>${escapeHtml(message)}</strong>
          ${listHtml}
        </div>
      `;
    }
    feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Handle Form Submission with AJAX & Duplicate Prevention
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Reset feedback and errors
    feedbackBox.style.display = 'none';
    feedbackBox.innerHTML = '';
    ['name', 'phone', 'email', 'service', 'resume', 'message'].forEach(clearFieldError);

    let hasError = false;

    // 1. Validate Name
    const nameInput = document.getElementById('name');
    if (!nameInput.value.trim()) {
      setFieldError('name', 'Please enter your full name.');
      hasError = true;
    }

    // 2. Validate Phone
    const phoneInput = document.getElementById('phone');
    const phoneVal = phoneInput.value.trim();
    const phoneRegex = /^[0-9\+\-\(\)\s]{7,25}$/;
    if (!phoneVal) {
      setFieldError('phone', 'Please enter your contact phone number.');
      hasError = true;
    } else if (!phoneRegex.test(phoneVal)) {
      setFieldError('phone', 'Please enter a valid phone number (digits, +, -, parentheses).');
      hasError = true;
    }

    // 3. Validate Email
    const emailInput = document.getElementById('email');
    const emailVal = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailVal) {
      setFieldError('email', 'Please enter your email address.');
      hasError = true;
    } else if (!emailRegex.test(emailVal)) {
      setFieldError('email', 'Please enter a valid email address.');
      hasError = true;
    }

    // 4. Validate Service Selection
    const serviceInput = document.getElementById('service');
    const allowedServices = [
      'Book Mock Interview Session',
      'Customise Your Resume',
      'Book Your 1:1 Sessions'
    ];
    if (!serviceInput.value || !allowedServices.includes(serviceInput.value)) {
      setFieldError('service', 'Please choose one of our exclusive services.');
      hasError = true;
    }

    // 5. Validate Resume File
    if (!fileInput.files || fileInput.files.length === 0) {
      setFieldError('resume', 'Please upload your resume (PDF, DOC, or DOCX).');
      hasError = true;
    } else {
      const file = fileInput.files[0];
      const validExtensions = ['pdf', 'doc', 'docx'];
      const ext = file.name.split('.').pop().toLowerCase();
      const maxSize = 10 * 1024 * 1024; // 10MB

      if (!validExtensions.includes(ext)) {
        setFieldError('resume', 'Invalid file type. Only PDF, DOC, and DOCX files are accepted.');
        hasError = true;
      } else if (file.size > maxSize) {
        setFieldError('resume', 'The resume file is too large. Maximum allowed size is 10 MB.');
        hasError = true;
      }
    }

    // 6. Validate Message
    const messageInput = document.getElementById('message');
    if (!messageInput.value.trim()) {
      setFieldError('message', 'Please enter your message.');
      hasError = true;
    } else if (messageInput.value.trim().length < 5) {
      setFieldError('message', 'Your message should be at least 5 characters.');
      hasError = true;
    }

    if (hasError) {
      showInlineMessage('error', 'Please complete all required fields correctly before submitting.');
      return;
    }

    // Prevent duplicate submissions: Disable button and show spinner
    submitBtn.disabled = true;
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Sending Message...';

    const formData = new FormData(form);

    fetch('/contact', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(async function (response) {
      const data = await response.json().catch(function () { return {}; });

      if (response.ok && data.success) {
        // Reset form & file label
        form.reset();
        fileLabel.innerHTML = '<i class="fa fa-cloud-upload mr-2 text-muted"></i> Choose PDF, DOC, or DOCX...';
        fileLabel.style.color = '#6a6a6a';

        // Display smooth inline success feedback (NO popup or alert)
        showInlineMessage('success', data.message || 'Thank you! Your message and resume have been sent to hrduo11@gmail.com.');
      } else if (response.status === 422 && data.errors) {
        // Handle server-side validation errors inline
        const errList = [];
        for (const [key, msgs] of Object.entries(data.errors)) {
          setFieldError(key, msgs[0]);
          errList.push(msgs[0]);
        }
        showInlineMessage('error', 'Please resolve the highlighted validation issues:', errList);
      } else {
        // Display exact SMTP delivery failure reason inline without popups
        showInlineMessage('error', data.message || 'An error occurred while sending your message. Please try again.');
      }
    })
    .catch(function (error) {
      showInlineMessage('error', 'A network connection error occurred while submitting. Please check your connection and try again.');
    })
    .finally(function () {
      // Re-enable button
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalBtnText;
    });
  });
});
</script>

@endsection
