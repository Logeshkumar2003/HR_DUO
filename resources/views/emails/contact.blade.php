<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>New Contact & Service Inquiry</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #232323; background-color: #f4f6f9; margin: 0; padding: 20px; }
    .container { max-width: 620px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); }
    .header { background-color: #232323; padding: 25px 30px; text-align: left; border-bottom: 4px solid #a4c639; }
    .header h2 { color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; }
    .header p { color: #a4c639; margin: 5px 0 0 0; font-size: 14px; }
    .body { padding: 30px; }
    .field-row { margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid #edf2f7; }
    .field-label { font-size: 12px; text-transform: uppercase; color: #718096; letter-spacing: 0.5px; font-weight: 600; margin-bottom: 4px; }
    .field-value { font-size: 15px; color: #1a202c; font-weight: 500; }
    .badge { display: inline-block; padding: 4px 12px; font-size: 13px; font-weight: 600; background-color: #eaf3d4; color: #5a7b13; border-radius: 20px; }
    .message-box { background-color: #f7fafc; border-left: 4px solid #a4c639; padding: 15px; border-radius: 4px; font-size: 14px; line-height: 1.6; color: #2d3748; white-space: pre-wrap; }
    .resume-box { background-color: #f0f7ff; border: 1px dashed #bee3f8; padding: 15px 20px; border-radius: 6px; margin-top: 15px; }
    .resume-btn { display: inline-block; background-color: #a4c639; color: #ffffff !important; text-decoration: none; padding: 10px 22px; border-radius: 25px; font-weight: 600; font-size: 14px; margin-top: 8px; }
    .footer { background-color: #edf2f7; padding: 18px 30px; text-align: center; font-size: 12px; color: #718096; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Job Agency Website</h2>
      <p>New Candidate Contact &amp; Service Inquiry</p>
    </div>

    <div class="body">
      <div class="field-row">
        <div class="field-label">Selected Exclusive Service</div>
        <div class="field-value">
          <span class="badge">{{ $inquiry['service'] }}</span>
        </div>
      </div>

      <div class="field-row">
        <div class="field-label">Full Name</div>
        <div class="field-value">{{ $inquiry['name'] }}</div>
      </div>

      <div class="field-row">
        <div class="field-label">Contact Number</div>
        <div class="field-value">
          <a href="tel:{{ $inquiry['phone'] }}" style="color: #2b6cb0; text-decoration: none;">{{ $inquiry['phone'] }}</a>
        </div>
      </div>

      <div class="field-row">
        <div class="field-label">Email Address</div>
        <div class="field-value">
          <a href="mailto:{{ $inquiry['email'] }}" style="color: #2b6cb0; text-decoration: none;">{{ $inquiry['email'] }}</a>
        </div>
      </div>

      <div class="field-row">
        <div class="field-label">User's Message</div>
        <div class="message-box">{{ $inquiry['message'] }}</div>
      </div>

      <div class="field-row" style="border-bottom: none;">
        <div class="field-label">Uploaded Resume</div>
        <div class="resume-box">
          <div style="font-size: 14px; color: #2c5282; font-weight: 600;">
            📄 {{ $inquiry['resume_filename'] ?? 'Resume Document' }}
          </div>
          <div style="font-size: 12px; color: #718096; margin-top: 3px;">
            The applicant's resume has been attached directly to this email.
          </div>
          @if(!empty($inquiry['resume_url']))
          <div style="margin-top: 10px;">
            <a href="{{ $inquiry['resume_url'] }}" class="resume-btn" target="_blank">Download Resume</a>
          </div>
          @endif
        </div>
      </div>
    </div>

    <div class="footer">
      This inquiry was submitted from the Contact Us form on {{ config('app.name', 'Job Agency') }} on {{ now()->format('F j, Y, g:i a') }}.
    </div>
  </div>
</body>
</html>

