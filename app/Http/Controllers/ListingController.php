<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Home page with featured jobs from database
     */
    public function home()
    {
        return view('home', [
            'featuredJobs' => Listing::orderBy('id', 'DESC')->take(3)->get()
        ]);
    }

    /**
     * Complete Jobs page with filtering and search
     */
    public function index(Request $request)
    {
        return view('jobs', [
            'listings' => Listing::filterIt($request)
        ]);
    }

    /**
     * Single listing detail page
     */
    public function show(Listing $listing)
    {
        return view('listing', [
            'listing' => $listing
        ]);
    }

    /**
     * Create job listing form (Admins only)
     */
    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to post jobs.');
        }

        return view('create');
    }

    /**
     * Store new job listing in database (Admins only)
     * All duplicate restrictions are removed - multiple jobs can have identical information.
     */
    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to post jobs.');
        }

        $this->normalizeRequestUrl($request, 'application_url');
        $this->normalizeRequestUrl($request, 'website');

        $fields = $request->validate([
            'title' => 'required|max:255',
            'company' => 'required|max:255', // Duplicate company names allowed
            'location' => 'required|max:255',
            'website' => ['required', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if (!$this->isValidWebUrl($value)) {
                    $fail('Please enter a valid website URL (HTTP, HTTPS, or www).');
                }
            }],
            'application_url' => ['required', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if (!$this->isValidWebUrl($value)) {
                    $fail('Please enter a valid application URL (HTTP, HTTPS, or www).');
                }
            }],
            'email' => ['required', 'email', 'max:255'],
            'tags' => 'required|max:255',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $fields['user_id'] = auth()->id();

        Listing::create($fields);

        return redirect('/jobs')->with('message', 'Job listing created successfully.');
    }

    /**
     * Edit listing form (Admins only)
     */
    public function edit(Listing $listing)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to edit jobs.');
        }

        return view('edit', ['listing' => $listing]);
    }

    /**
     * Update existing listing (Admins only)
     * All duplicate restrictions are removed.
     */
    public function update(Request $request, Listing $listing)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to update jobs.');
        }

        $this->normalizeRequestUrl($request, 'application_url');
        $this->normalizeRequestUrl($request, 'website');

        $fields = $request->validate([
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'location' => 'required|max:255',
            'website' => ['required', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if (!$this->isValidWebUrl($value)) {
                    $fail('Please enter a valid website URL (HTTP, HTTPS, or www).');
                }
            }],
            'application_url' => ['required', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if (!$this->isValidWebUrl($value)) {
                    $fail('Please enter a valid application URL (HTTP, HTTPS, or www).');
                }
            }],
            'email' => ['required', 'email', 'max:255'],
            'tags' => 'required|max:255',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($fields);

        return redirect('/listings/' . $listing->id)->with('message', 'Job listing updated successfully.');
    }

    /**
     * Delete listing (Admins only)
     */
    public function destroy(Listing $listing)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to delete jobs.');
        }

        $listing->delete();
        return redirect('/jobs')->with('message', 'Job listing deleted successfully.');
    }

    /**
     * Manage all job listings (Admins only)
     */
    public function manage()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Only administrators have permission to manage jobs.');
        }

        return view('manage', [
            'listings' => Listing::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Normalize URL in request (auto-prefix scheme if www or scheme missing)
     */
    private function normalizeRequestUrl(Request $request, string $key): void
    {
        if ($request->filled($key)) {
            $url = trim($request->input($key));

            // Disallow unsafe schemes (javascript:, data:, vbscript:, file:)
            if (preg_match('~^(?:javascript|data|vbscript|file):~i', $url)) {
                return;
            }

            // If starts with www. or doesn't have a protocol scheme, prepend https://
            if (!preg_match('~^https?://~i', $url)) {
                $url = 'https://' . $url;
            }

            $request->merge([$key => $url]);
        }
    }

    /**
     * Validate whether a string is a safe and valid web URL (HTTP or HTTPS)
     */
    private function isValidWebUrl(?string $url): bool
    {
        if (empty($url)) {
            return false;
        }

        $trimmed = trim($url);

        // Disallow unsafe schemes
        if (preg_match('~^(?:javascript|data|vbscript|file):~i', $trimmed)) {
            return false;
        }

        // Must start with http:// or https:// (after normalization)
        if (!preg_match('~^https?://~i', $trimmed)) {
            return false;
        }

        // Must pass filter_var URL check or regex for URLs with complex queries/fragments
        if (filter_var($trimmed, FILTER_VALIDATE_URL) !== false) {
            return true;
        }

        // Fallback for URLs with non-standard query structures or square brackets
        return (bool) preg_match('~^https?://[a-zA-Z0-9\-._~:/?#\[\]@!$&\'()*+,;=%]+$~i', $trimmed);
    }
}
