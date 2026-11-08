<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Tests\TestCase;

class JobApplicationUrlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Ensure Main Admin exists
        User::firstOrCreate(
            ['email' => 'Nitta.prasanthi19@gmail.com'],
            [
                'name' => 'Main Admin',
                'password' => bcrypt('Pavanganesh@9985&7702!10!'),
                'role' => 'main_admin'
            ]
        );
    }

    public function test_admin_can_create_multiple_jobs_with_same_company_name()
    {
        $admin = User::where('role', 'main_admin')->first();

        // Job 1 for Accenture
        $response1 = $this->actingAs($admin)->post('/create', [
            'title' => 'Software Engineer',
            'company' => 'Accenture',
            'location' => 'Bengaluru, India',
            'website' => 'https://www.accenture.com',
            'application_url' => 'https://www.accenture.com/careers/job1',
            'email' => 'careers@accenture.com',
            'tags' => 'java, spring',
            'description' => 'Develop scalable enterprise solutions.'
        ]);
        $response1->assertRedirect('/jobs');

        // Job 2 for Accenture (Duplicate company name allowed)
        $response2 = $this->actingAs($admin)->post('/create', [
            'title' => 'Cloud DevOps Specialist',
            'company' => 'Accenture',
            'location' => 'Hyderabad, India',
            'website' => 'https://www.accenture.com',
            'application_url' => 'https://www.accenture.com/careers/job2',
            'email' => 'careers@accenture.com',
            'tags' => 'aws, devops, kubernetes',
            'description' => 'Manage multi-cloud infrastructure and pipelines.'
        ]);
        $response2->assertRedirect('/jobs');

        // Confirm both exist in database with different IDs
        $jobs = Listing::where('company', 'Accenture')->get();
        $this->assertGreaterThanOrEqual(2, $jobs->count());
        $this->assertNotEquals($jobs[0]->id, $jobs[1]->id);
    }

    public function test_admin_can_create_completely_identical_job_postings()
    {
        $admin = User::where('role', 'main_admin')->first();

        $jobData = [
            'title' => 'Senior Site Reliability Engineer',
            'company' => 'Google Cloud Partner',
            'location' => 'Remote',
            'website' => 'www.googlecloudpartner.com',
            'application_url' => 'https://careers.googlecloudpartner.com/apply/sre?team=infra&ref=portal_2026',
            'email' => 'hiring@googlecloudpartner.com',
            'tags' => 'sre, linux, go, kubernetes',
            'description' => 'Ensure 99.99% availability of high-throughput distributed microservices.'
        ];

        // Post 1
        $response1 = $this->actingAs($admin)->post('/create', $jobData);
        $response1->assertRedirect('/jobs');

        // Post 2 - 100% Identical in every field
        $response2 = $this->actingAs($admin)->post('/create', $jobData);
        $response2->assertRedirect('/jobs');

        $identicalJobs = Listing::where('title', 'Senior Site Reliability Engineer')
            ->where('company', 'Google Cloud Partner')
            ->get();

        $this->assertGreaterThanOrEqual(2, $identicalJobs->count());
        $jobA = $identicalJobs->shift();
        $jobB = $identicalJobs->shift();

        // Each has its own unique internal Job ID
        $this->assertNotEquals($jobA->id, $jobB->id);
        $this->assertEquals($jobA->title, $jobB->title);
        $this->assertEquals($jobA->company, $jobB->company);
        $this->assertEquals($jobA->application_url, $jobB->application_url);
    }

    public function test_editing_or_deleting_one_duplicate_job_does_not_affect_the_other()
    {
        $admin = User::where('role', 'main_admin')->first();

        $job1 = Listing::create([
            'user_id' => $admin->id,
            'title' => 'Data Analyst',
            'company' => 'TCS',
            'location' => 'Mumbai',
            'website' => 'https://www.tcs.com',
            'application_url' => 'https://ibegin.tcs.com/apply/1',
            'email' => 'jobs@tcs.com',
            'tags' => 'sql, python',
            'description' => 'Analyze enterprise data.'
        ]);

        $job2 = Listing::create([
            'user_id' => $admin->id,
            'title' => 'Data Analyst',
            'company' => 'TCS',
            'location' => 'Mumbai',
            'website' => 'https://www.tcs.com',
            'application_url' => 'https://ibegin.tcs.com/apply/2',
            'email' => 'jobs@tcs.com',
            'tags' => 'sql, python',
            'description' => 'Analyze enterprise data.'
        ]);

        // Edit Job 1
        $this->actingAs($admin)->put('/listings/' . $job1->id, [
            'title' => 'Senior Lead Data Analyst',
            'company' => 'TCS',
            'location' => 'Pune',
            'website' => 'https://www.tcs.com',
            'application_url' => 'https://ibegin.tcs.com/apply/1-updated',
            'email' => 'jobs@tcs.com',
            'tags' => 'sql, python, tableau',
            'description' => 'Lead analytics engineering team.'
        ]);

        $this->assertEquals('Senior Lead Data Analyst', $job1->fresh()->title);
        $this->assertEquals('Data Analyst', $job2->fresh()->title); // Job 2 unaffected

        // Delete Job 1
        $this->actingAs($admin)->delete('/listings/' . $job1->id);

        $this->assertNull(Listing::find($job1->id));
        $this->assertNotNull(Listing::find($job2->id)); // Job 2 still intact
    }

    public function test_accepts_various_valid_website_and_application_urls()
    {
        $admin = User::where('role', 'main_admin')->first();

        // 1. URL starting with www. (auto prepends https://)
        $this->actingAs($admin)->post('/create', [
            'title' => 'Fullstack Developer',
            'company' => 'Workday Tech Client ' . rand(100, 999),
            'location' => 'New York, NY',
            'website' => 'www.workdayclient.com',
            'application_url' => 'https://accenture.wd3.myworkdayjobs.com/AccentureCareers/job/Bengaluru/Developer_R00234567#apply',
            'email' => 'jobs@workdayclient.com',
            'tags' => 'react, node',
            'description' => 'Build high performance apps.'
        ]);

        $savedJob = Listing::where('title', 'Fullstack Developer')->orderBy('id', 'desc')->first();
        $this->assertEquals('https://www.workdayclient.com', $savedJob->website);
        $this->assertEquals('https://accenture.wd3.myworkdayjobs.com/AccentureCareers/job/Bengaluru/Developer_R00234567#apply', $savedJob->application_url);

        // 2. LinkedIn URL with query parameters
        $this->actingAs($admin)->post('/create', [
            'title' => 'Product Manager',
            'company' => 'LinkedIn Client ' . rand(100, 999),
            'location' => 'San Francisco, CA',
            'website' => 'http://careers.techmahindra.com/index.html?src=nav',
            'application_url' => 'www.linkedin.com/jobs/view/1234567890/?refId=abcd1234efgh&trackingId=tracking_token_9999',
            'email' => 'pm@linkedinclient.com',
            'tags' => 'product, agile',
            'description' => 'Drive product roadmap and strategy.'
        ]);

        $savedPM = Listing::where('title', 'Product Manager')->orderBy('id', 'desc')->first();
        $this->assertEquals('http://careers.techmahindra.com/index.html?src=nav', $savedPM->website);
        $this->assertEquals('https://www.linkedin.com/jobs/view/1234567890/?refId=abcd1234efgh&trackingId=tracking_token_9999', $savedPM->application_url);
    }

    public function test_rejects_unsafe_schemes()
    {
        $admin = User::where('role', 'main_admin')->first();

        $response = $this->actingAs($admin)->post('/create', [
            'title' => 'Malicious Script Job',
            'company' => 'Bad Actor Co',
            'location' => 'Nowhere',
            'website' => 'javascript:alert(document.cookie)',
            'application_url' => 'data:text/html;base64,PHNjcmlwdD5hbGVydCgxKTwvc2NyaXB0Pg==',
            'email' => 'bad@actor.com',
            'tags' => 'security',
            'description' => 'Testing security protections.'
        ]);

        $response->assertSessionHasErrors(['website', 'application_url']);
    }

    public function test_secondary_admin_can_create_duplicate_jobs_and_manage_all_urls()
    {
        $secondaryAdmin = User::firstOrCreate(
            ['email' => 'secondary.admin@agency.com'],
            [
                'name' => 'Secondary Admin',
                'password' => bcrypt('AdminSecPass@2026!'),
                'role' => 'secondary_admin'
            ]
        );

        // Secondary admin posts Job 1 for Infosys
        $response1 = $this->actingAs($secondaryAdmin)->post('/create', [
            'title' => 'Systems Engineer',
            'company' => 'Infosys',
            'location' => 'Mysuru, India',
            'website' => 'www.infosys.com',
            'application_url' => 'https://career.infosys.com/jobdesc?jobReferenceCode=INF101&track=direct',
            'email' => 'talent@infosys.com',
            'tags' => 'python, devops',
            'description' => 'Entry to mid level systems engineering.'
        ]);
        $response1->assertRedirect('/jobs');

        // Secondary admin posts Job 2 for Infosys (Duplicate company allowed)
        $response2 = $this->actingAs($secondaryAdmin)->post('/create', [
            'title' => 'Lead Consultant',
            'company' => 'Infosys',
            'location' => 'Bengaluru, India',
            'website' => 'https://www.infosys.com/careers.html',
            'application_url' => 'https://career.infosys.com/jobdesc?jobReferenceCode=INF202&track=portal#details',
            'email' => 'talent@infosys.com',
            'tags' => 'cloud, enterprise',
            'description' => 'Senior enterprise consulting.'
        ]);
        $response2->assertRedirect('/jobs');

        $infosysJobs = Listing::where('company', 'Infosys')->get();
        $this->assertGreaterThanOrEqual(2, $infosysJobs->count());
    }

    public function test_client_facing_details_page_displays_all_required_info_and_single_apply_now_button()
    {
        $admin = User::where('role', 'main_admin')->first();

        $listing = Listing::create([
            'user_id' => $admin->id,
            'title' => 'Senior Backend Developer',
            'company' => 'InnovateX ' . rand(1000, 9999),
            'location' => 'Seattle, WA',
            'website' => 'https://innovatex.io',
            'application_url' => 'https://jobs.lever.co/innovatex/backend-lead?ref=linkedin&src=social',
            'email' => 'recruiting@innovatex.io',
            'tags' => 'laravel, postgresql, api',
            'description' => 'Build resilient enterprise APIs with Laravel and PostgreSQL.'
        ]);

        $response = $this->get('/listings/' . $listing->id);
        $response->assertStatus(200);

        // Required Information Checks:
        $response->assertSee('Senior Backend Developer');
        $response->assertSee($listing->company);
        $response->assertSee('Seattle, WA');
        $response->assertSee('recruiting@innovatex.io');
        $response->assertSee('https://innovatex.io');
        $response->assertSee('laravel');
        $response->assertSee('Build resilient enterprise APIs with Laravel and PostgreSQL.');
        
        // Single Apply Now Button with exact application URL in new tab:
        $response->assertSee('https://jobs.lever.co/innovatex/backend-lead?ref=linkedin&src=social');
        $response->assertSee('Apply Now');
        $response->assertSee('target="_blank"', false);
        $response->assertSee('btn-apply-now');

        // Removed buttons check:
        $response->assertDontSee('Apply via Email');
        $response->assertDontSee('Visit Company Website');
    }

    public function test_manage_page_displays_application_url()
    {
        $admin = User::where('role', 'main_admin')->first();

        $listing = Listing::create([
            'user_id' => $admin->id,
            'title' => 'Frontend Engineer',
            'company' => 'Webify ' . rand(1000, 9999),
            'location' => 'New York, NY',
            'website' => 'https://webify.com',
            'application_url' => 'https://boards.greenhouse.io/webify/jobs/12345?gh_jid=12345',
            'email' => 'hr@webify.com',
            'tags' => 'react, typescript',
            'description' => 'Build modern frontends.'
        ]);

        $response = $this->actingAs($admin)->get('/manage');
        $response->assertStatus(200);
        $response->assertSee('Application URL');
        $response->assertSee('https://boards.greenhouse.io/webify/jobs/12345?gh_jid=12345');
    }
}
