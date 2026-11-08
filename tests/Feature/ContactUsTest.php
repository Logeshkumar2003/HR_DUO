<?php

namespace Tests\Feature;

use App\Mail\ContactInquiryMail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    /**
     * Test Contact Us page loads with all required fields and options
     */
    public function test_contact_page_has_all_required_fields_and_no_browser_alerts()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);

        // Check required fields
        $response->assertSee('name="name"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="service"', false);
        $response->assertSee('name="resume"', false);
        $response->assertSee('name="message"', false);

        // Check service options
        $response->assertSee('Book Mock Interview Session');
        $response->assertSee('Customise Your Resume');
        $response->assertSee('Book Your 1:1 Sessions');

        // Check file types indicated
        $response->assertSee('PDF, DOC, DOCX');

        // Check recipient email visible in information boxes
        $response->assertSee('hrduo11@gmail.com');

        // Verify no browser alert() or confirm() exists in the rendered HTML
        $content = $response->getContent();
        $this->assertStringNotContainsString('alert(', $content);
        $this->assertStringNotContainsString('confirm(', $content);
    }

    /**
     * Test form validation rejects missing or invalid inputs
     */
    public function test_form_validation_for_required_fields_and_formats()
    {
        $response = $this->post('/contact', [], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'phone', 'email', 'service', 'resume', 'message']);

        // Test invalid email & invalid phone format
        $invalidFormatRes = $this->post('/contact', [
            'name' => 'John Doe',
            'phone' => 'invalid-abc',
            'email' => 'not-an-email',
            'service' => 'Fake Service',
            'resume' => UploadedFile::fake()->create('script.exe', 100),
            'message' => 'hi'
        ], ['Accept' => 'application/json']);

        $invalidFormatRes->assertStatus(422);
        $invalidFormatRes->assertJsonValidationErrors(['phone', 'email', 'service', 'resume', 'message']);
    }

    /**
     * Test successful AJAX submission dispatches email directly to hrduo11@gmail.com WITHOUT creating database records
     */
    public function test_successful_contact_submission_via_ajax_without_database_storage()
    {
        Mail::fake();
        Storage::fake('public');

        $initialCount = DB::table('contact_inquiries')->count();

        $resumeFile = UploadedFile::fake()->create('alex_morgan_resume.pdf', 300, 'application/pdf');

        $payload = [
            'name' => 'Alex Morgan',
            'phone' => '+1 (555) 789-1234',
            'email' => 'alex.morgan@example.com',
            'service' => 'Book Mock Interview Session',
            'resume' => $resumeFile,
            'message' => 'I would like to book a mock interview for senior frontend role.',
        ];

        $response = $this->post('/contact', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'email_delivered' => true,
        ]);

        // Verify NO database record was created
        $this->assertEquals($initialCount, DB::table('contact_inquiries')->count(), 'No database records should be created for Contact Us inquiries');

        // Verify email dispatched to hrduo11@gmail.com
        Mail::assertSent(ContactInquiryMail::class, function ($mail) {
            return $mail->hasTo('hrduo11@gmail.com') &&
                   $mail->inquiry['service'] === 'Book Mock Interview Session' &&
                   $mail->inquiry['name'] === 'Alex Morgan';
        });
    }

    /**
     * Test successful standard POST submission redirects with inline session status WITHOUT database records
     */
    public function test_successful_standard_post_submission_without_database_storage()
    {
        Mail::fake();
        Storage::fake('public');

        $initialCount = DB::table('contact_inquiries')->count();

        $resumeDoc = UploadedFile::fake()->create('resume_custom.docx', 400, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        $payload = [
            'name' => 'Sarah Connor',
            'phone' => '+1 333 444 5555',
            'email' => 'sarah@example.com',
            'service' => 'Customise Your Resume',
            'resume' => $resumeDoc,
            'message' => 'Please help customize my resume for management consulting.',
        ];

        $response = $this->post('/contact', $payload);

        $response->assertRedirect('/contact#contact-section');
        $response->assertSessionHas('contact_success');

        // Verify NO database record was created
        $this->assertEquals($initialCount, DB::table('contact_inquiries')->count(), 'No database records should be created for Contact Us inquiries');
    }

    /**
     * Test contact submission handles mail delivery exception gracefully without saving to DB
     */
    public function test_contact_submission_handles_mail_failure_gracefully()
    {
        Mail::shouldReceive('to')->andReturnSelf();
        Mail::shouldReceive('send')->andThrow(new \Exception('530 Authentication Required'));
        Storage::fake('public');

        $initialCount = DB::table('contact_inquiries')->count();

        $resumeFile = UploadedFile::fake()->create('test_resume.pdf', 200, 'application/pdf');

        $payload = [
            'name' => 'Grace Hopper',
            'phone' => '+1 888 999 0000',
            'email' => 'grace@example.com',
            'service' => 'Book Your 1:1 Sessions',
            'resume' => $resumeFile,
            'message' => 'Inquiry testing mail failure handling.',
        ];

        $response = $this->post('/contact', $payload, ['Accept' => 'application/json']);

        // Should return 502 with error message
        $response->assertStatus(502);
        $response->assertJson([
            'success' => false,
            'email_delivered' => false,
        ]);

        // Verify NO database record was created
        $this->assertEquals($initialCount, DB::table('contact_inquiries')->count(), 'No database records should be created even upon mail failure');
    }
}
