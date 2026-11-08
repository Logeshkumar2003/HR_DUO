# Unified Job Agency & Listings Application (template131)

This is the unified project integrating **template131** (primary frontend design and multi-page website) and the dynamic **Job Listings Application** into a single cohesive Laravel application.

---

## Architecture Overview

- **Primary Website (template131)**:
  - Homepage (`/`) with banner slider, dynamic featured jobs from the database, company information, blog previews, testimonials, and exclusive career services callout.
  - Informational Pages: About Us (`/about`), Team (`/team`), Blog (`/blog`), Blog Details (`/blog-details`), Testimonials (`/testimonials`), Terms (`/terms`), and Contact Us (`/contact`).
- **Integrated Jobs Application**:
  - Full Job Listings Page (`/jobs`): Accessible directly via the **Jobs** navigation button in the top menu and hero banners.
  - Job Search & Tag Filtering: Keyword search across titles, descriptions, and tags (`/jobs?search=...`, `/jobs?tag=...`).
  - Single Job Details (`/listings/{id}`): Detailed job overview, contact options, company website link, and admin management actions (Edit & Delete).
  - Admin Job Management (`/manage`): Dedicated dashboard for verified administrators to manage, edit, and delete job postings.
  - Post a Job (`/create`): Protected form with company logo upload and validation, restricted to administrators.

---

## Contact Us & Exclusive Career Services

The Contact Us section (`/contact`) has been upgraded into a career services inquiry portal:

### 1. Form Fields
- **Name**: Text input (Full name).
- **Contact Number**: Phone input with international and national format validation (`digits, +, -, ()`).
- **Email Address**: Email input with format validation.
- **Upload Your Resume**: File upload supporting `.pdf`, `.doc`, and `.docx` up to 10 MB with interactive file-name preview.
- **Choose Our Exclusive Service**: Dropdown featuring:
  - `Book Mock Interview Session`
  - `Customise Your Resume`
  - `Book Your 1:1 Sessions`
- **Your Message**: Multiline textarea for personalized career goals and requirements.
- **Send Message**: Submit button with duplicate-submission prevention and loading spinner.

### 2. Direct Email Delivery (Zero Database Storage)
- Submissions are dispatched directly to **`hrduo11@gmail.com`** via Gmail SMTP (`smtp.gmail.com:587`, STARTTLS).
- No database records or reference numbers are created for Contact Us inquiries.
- Emails include the applicant's name, phone, email, selected service, message, and the uploaded resume as an attachment.

### 3. Smooth, Zero-Popup User Experience
- **No Browser Alerts or Popups**: All browser confirmation dialogs (`confirm(...)`), popup notifications, and browser alerts (`alert(...)`) have been completely removed across the entire application.
- **Inline Validation & Feedback**: All validation errors and success confirmations appear smoothly inline directly within the Contact Us card without interrupting the user.
- **Duplicate Submission Prevention**: The submit button disables instantly upon click, displays a spinner, and resets the form upon successful completion.

---

## Role-Based Access Control (RBAC) System

Public self-registration is disabled. Only administrators may add, edit, delete, or manage job postings.

### 1. Permanent Main Administrator
- **Email**: `Nitta.prasanthi19@gmail.com`
- **Password**: `Pavanganesh@9985&7702!10!`
- **Capabilities**:
  - Exclusive access to **Admin Access Management** (`/admin/access`).
  - Can create and grant secondary administrator accounts with encrypted passwords.
  - Can view all active administrators and immediately revoke/delete secondary admins.
  - Cannot be deleted or revoked by anyone.
  - Full operational access to add, edit, delete, and manage all job postings.

### 2. Secondary Administrators
- **Creation**: Created directly by the Main Admin in the Admin Access Management panel.
- **Capabilities**:
  - Post new jobs (`/create`).
  - Edit existing jobs (`/listings/{id}/edit`).
  - Delete jobs.
  - View and manage all job postings (`/manage`).
- **Strict Restrictions**:
  - Prohibited from accessing `/admin/access` (enforced at route middleware and controller level with HTTP 403 Forbidden).
  - Cannot grant or revoke admin privileges.
  - Cannot modify or delete the Main Admin.

### 3. Public Visitors
- Can browse all pages, search job listings, filter by tag, view job details, and contact employers.
- Self-registration is disabled (attempts to visit `/register` redirect to `/login`).
- Cannot post, edit, or delete jobs.

---

## Prerequisites

- **PHP** (8.0 or higher)
- **Composer** (2.x)
- **MySQL** (running on port `3306`)

---

## Running the Application

### Method 1: Using the VS Code Terminal (Quickest)

1. Open the project folder (`template131`) in VS Code.
2. Open terminal (<kbd>Ctrl</kbd> + <kbd>`</kbd>).
3. Start the server:
   ```bash
   php artisan serve
   ```
4. Open your browser and navigate to:
   👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

### Method 2: One-Click Run in VS Code

1. Press <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>B</kbd> (or go to **Terminal > Run Build Task...**).
2. Select **`Start Unified Website (template131)`**.

---

## Automated Security & Feature Verification

Run the complete automated test suite (all 8 tests, 72 assertions):

```bash
.\vendor\bin\phpunit tests/Feature
```

Tests cover:
- Admin role enforcement, access control, bcrypt password encryption, and self-registration blocking (`AdminSecurityTest.php`).
- Contact form field structure, email dispatch to `hrduo11@gmail.com`, file validation, resume attachment, and inline feedback (`ContactUsTest.php`).

---

## Key Routes Summary

| Route | Description | Access Level |
|---|---|---|
| `/` | Main Homepage (template131) with dynamic featured jobs | Public |
| `/jobs` | Integrated Jobs Application (replaces old `jobs.html`) | Public |
| `/listings/{id}` | Single Job Listing Details (replaces old `job-details.html`) | Public |
| `/about`, `/team`, `/blog`, `/testimonials`, `/terms` | Informational pages | Public |
| `/contact` | Upgraded Contact Us & Career Services (Email to hrduo11@gmail.com) | Public |
| `/login` | Administrator Login Portal (clean form, no demo credentials) | Guest / Public |
| `/register` | Disabled registration endpoint (redirects to `/login`) | Disabled |
| `/logout` | Terminates active administrator session | Authenticated |
| `/manage` | Admin Dashboard: View and manage all job postings | Admins Only (Main & Secondary) |
| `/create` | Post a New Job listing | Admins Only (Main & Secondary) |
| `/listings/{id}/edit` | Edit existing job listing | Admins Only (Main & Secondary) |
| `/admin/access` | Admin Access Management (Grant & Revoke admin privileges) | **Main Admin Only** |
