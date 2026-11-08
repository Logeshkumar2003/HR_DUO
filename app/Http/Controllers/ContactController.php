<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Show the Contact Us page
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Process Contact Us submission and dispatch email directly to hrduo11@gmail.com (No database storage)
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9\+\-\(\)\s]{7,25}$/'],
            'email' => ['required', 'email', 'max:255'],
            'service' => ['required', 'string', Rule::in([
                'Book Mock Interview Session',
                'Customise Your Resume',
                'Book Your 1:1 Sessions'
            ])],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'message' => ['required', 'string', 'min:5', 'max:5000'],
        ], [
            'name.required' => 'Please enter your full name.',
            'phone.required' => 'Please provide a contact phone number.',
            'phone.regex' => 'Please enter a valid contact number (digits, +, -, parentheses).',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please provide a valid email address.',
            'service.required' => 'Please choose one of our exclusive services.',
            'service.in' => 'Please select a valid exclusive service option.',
            'resume.required' => 'Please upload your resume (PDF, DOC, or DOCX).',
            'resume.mimes' => 'Resume format must be PDF, DOC, or DOCX.',
            'resume.max' => 'The resume file size must not exceed 10 MB.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message must be at least 5 characters.',
        ]);

        // Process uploaded resume file for attachment
        $resumeFile = $request->file('resume');
        $originalFilename = $resumeFile->getClientOriginalName();
        $storedPath = $resumeFile->store('resumes', 'public');
        $fullPath = storage_path('app/public/' . $storedPath);

        // Prepare email data
        $inquiryData = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'service' => $validated['service'],
            'resume_filename' => $originalFilename,
            'message' => $validated['message'],
        ];

        // Direct Email Delivery to hrduo11@gmail.com
        $emailSent = false;
        $deliveryError = null;

        try {
            Mail::to('hrduo11@gmail.com')->send(new ContactInquiryMail($inquiryData, $fullPath, $originalFilename));
            $emailSent = true;
            Log::info("Contact form submission from {$validated['email']} successfully delivered to hrduo11@gmail.com");
        } catch (\Throwable $e) {
            $emailSent = false;
            $deliveryError = $e->getMessage();
            Log::error("SMTP delivery failure to hrduo11@gmail.com: " . $deliveryError);
        }

        // Return verified delivery feedback
        if ($emailSent) {
            $successMsg = 'Thank you, ' . e($validated['name']) . '! Your message, chosen service (' . e($validated['service']) . '), and resume have been successfully delivered to our HR team at hrduo11@gmail.com. We will get back to you shortly.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'email_delivered' => true,
                    'message' => $successMsg
                ]);
            }

            return redirect('/contact#contact-section')->with('contact_success', $successMsg);
        } else {
            $cleanReason = $this->sanitizeMailError($deliveryError);
            $failMsg = 'Failed to deliver email to hrduo11@gmail.com: ' . $cleanReason . ' Please ensure valid Gmail SMTP credentials (with an App Password) are configured in .env.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'email_delivered' => false,
                    'message' => $failMsg
                ], 502);
            }

            return redirect('/contact#contact-section')->with('contact_error', $failMsg);
        }
    }

    /**
     * Format raw SMTP error message into clear explanation
     */
    protected function sanitizeMailError(?string $error): string
    {
        if (!$error) {
            return 'Unknown mail transport error.';
        }

        if (str_contains($error, '530') || str_contains($error, 'Authentication Required')) {
            return '530 Authentication Required. Gmail requires SMTP authentication with a Google App Password.';
        }

        if (str_contains($error, '535') || str_contains($error, 'BadCredentials') || str_contains($error, 'Username and Password not accepted')) {
            return '535 Bad Credentials. Google rejected the provided username or App Password.';
        }

        if (str_contains($error, 'Connection could not be established') || str_contains($error, 'getaddrinfo failed')) {
            return 'Could not connect to SMTP host. Verify MAIL_HOST and internet connectivity.';
        }

        if (str_contains($error, 'Connection timed out')) {
            return 'SMTP connection timed out. Check port and firewall.';
        }

        return substr($error, 0, 180);
    }
}
