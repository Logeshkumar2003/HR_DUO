<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminAccessController extends Controller
{
    /**
     * Display the Admin Access Management dashboard (Main Admin only)
     */
    public function index()
    {
        // Enforce strict backend check
        if (!auth()->check() || !auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized. Only the designated Main Administrator can access this section.');
        }

        $mainAdminEmail = strtolower(config('admin.main_admin_email', 'Nitta.prasanthi19@gmail.com'));

        $admins = User::where('role', 'main_admin')
            ->orWhere('role', 'secondary_admin')
            ->orWhereRaw('LOWER(email) = ?', [$mainAdminEmail])
            ->orderByRaw("CASE WHEN LOWER(email) = '{$mainAdminEmail}' OR role = 'main_admin' THEN 0 ELSE 1 END")
            ->orderBy('id', 'ASC')
            ->get();

        return view('admin.access', [
            'admins' => $admins
        ]);
    }

    /**
     * Grant secondary admin access
     */
    public function store(Request $request)
    {
        // Enforce strict backend check
        if (!auth()->check() || !auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized. Only the designated Main Administrator can grant admin access.');
        }

        $fields = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $mainAdminEmail = strtolower(config('admin.main_admin_email', 'Nitta.prasanthi19@gmail.com'));
        $targetEmail = strtolower(trim($fields['email']));

        if ($targetEmail === $mainAdminEmail) {
            return back()->withErrors(['email' => 'The Main Administrator account is permanent and cannot be modified here.'])->withInput();
        }

        // Check if user already exists
        $user = User::whereRaw('LOWER(email) = ?', [$targetEmail])->first();

        if ($user) {
            $user->name = $fields['name'] ?: ($user->name ?: 'Secondary Admin');
            $user->password = Hash::make($fields['password']);
            $user->role = 'secondary_admin';
            $user->save();
            $msg = "Secondary admin access updated and granted for {$user->email}.";
        } else {
            $user = User::create([
                'name' => $fields['name'] ?: 'Secondary Admin',
                'email' => $targetEmail,
                'password' => Hash::make($fields['password']),
                'role' => 'secondary_admin',
            ]);
            $msg = "Secondary admin account successfully created for {$user->email}.";
        }

        return back()->with('message', $msg);
    }

    /**
     * Revoke admin access and delete secondary admin account
     */
    public function destroy(User $user)
    {
        // Enforce strict backend check
        if (!auth()->check() || !auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized. Only the designated Main Administrator can revoke admin access.');
        }

        $mainAdminEmail = strtolower(config('admin.main_admin_email', 'Nitta.prasanthi19@gmail.com'));

        // Prevent deleting the Main Admin
        if ($user->isMainAdmin() || strtolower($user->email) === $mainAdminEmail) {
            abort(403, 'Fatal security violation: The Main Administrator account cannot be deleted or revoked.');
        }

        $email = $user->email;
        $user->delete();

        return back()->with('message', "Admin access revoked and account removed for {$email}.");
    }
}

