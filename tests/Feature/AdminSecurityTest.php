<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminSecurityTest extends TestCase
{
    /**
     * Test permanent Main Admin account integrity
     */
    public function test_main_admin_integrity()
    {
        $mainAdmin = User::whereRaw('LOWER(email) = ?', ['nitta.prasanthi19@gmail.com'])->first();
        
        $this->assertNotNull($mainAdmin, 'Main Admin account must exist in the database');
        $this->assertEquals('main_admin', $mainAdmin->role);
        $this->assertTrue(Hash::check('Pavanganesh@9985&7702!10!', $mainAdmin->password), 'Main Admin password must match specified password');
        $this->assertTrue($mainAdmin->isMainAdmin(), 'isMainAdmin() must be true');
        $this->assertTrue($mainAdmin->isAdmin(), 'isAdmin() must be true');
        $this->assertFalse($mainAdmin->isSecondaryAdmin(), 'isSecondaryAdmin() must be false');
    }

    /**
     * Test public self-registration is disabled
     */
    public function test_registration_is_disabled()
    {
        $response = $this->get('/register');
        $response->assertRedirect('/login');

        $responsePost = $this->post('/register', [
            'name' => 'Self Registered User',
            'email' => 'selfreg@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123'
        ]);
        $responsePost->assertRedirect('/login');
    }

    /**
     * Test unauthenticated access to admin routes is blocked
     */
    public function test_unauthenticated_users_are_redirected_to_login()
    {
        $this->get('/admin/access')->assertRedirect('/login');
        $this->get('/manage')->assertRedirect('/login');
        $this->get('/create')->assertRedirect('/login');
    }

    /**
     * Test Main Admin can view Admin Access Management and create Secondary Admin
     */
    public function test_main_admin_can_manage_secondary_admins()
    {
        $mainAdmin = User::whereRaw('LOWER(email) = ?', ['nitta.prasanthi19@gmail.com'])->first();

        // Main Admin can view dashboard
        $response = $this->actingAs($mainAdmin)->get('/admin/access');
        $response->assertStatus(200);
        $response->assertSee('Admin Access Management');
        $response->assertSee('Grant Admin Access');

        // Main Admin creates Secondary Admin
        $secEmail = 'secondary.test.' . time() . '@example.com';
        $secPassword = 'SecurePassword@2026!';
        
        $createRes = $this->actingAs($mainAdmin)->post('/admin/access', [
            'name' => 'Secondary Admin Agent',
            'email' => $secEmail,
            'password' => $secPassword
        ]);
        $createRes->assertSessionHas('message');

        // Verify Secondary Admin created with HASHED password in DB
        $secUser = User::whereRaw('LOWER(email) = ?', [strtolower($secEmail)])->first();
        $this->assertNotNull($secUser);
        $this->assertEquals('secondary_admin', $secUser->role);
        $this->assertStringStartsWith('$2y$', $secUser->password, 'Password must be bcrypt hashed in database');
        $this->assertTrue(Hash::check($secPassword, $secUser->password));
        $this->assertTrue($secUser->isAdmin());
        $this->assertTrue($secUser->isSecondaryAdmin());
        $this->assertFalse($secUser->isMainAdmin());

        // Secondary Admin CAN access job management
        $this->actingAs($secUser)->get('/manage')->assertStatus(200);
        $this->actingAs($secUser)->get('/create')->assertStatus(200);

        // Secondary Admin CANNOT access or modify admin access management (403 Forbidden)
        $this->actingAs($secUser)->get('/admin/access')->assertStatus(403);
        $this->actingAs($secUser)->post('/admin/access', [
            'name' => 'Unauthorized Admin',
            'email' => 'unauthorized@example.com',
            'password' => 'Pass@123'
        ])->assertStatus(403);

        $this->actingAs($secUser)->delete('/admin/access/' . $mainAdmin->id)->assertStatus(403);

        // Main Admin CANNOT delete themselves (403 Forbidden)
        $this->actingAs($mainAdmin)->delete('/admin/access/' . $mainAdmin->id)->assertStatus(403);

        // Main Admin CAN revoke and delete the Secondary Admin
        $revokeRes = $this->actingAs($mainAdmin)->delete('/admin/access/' . $secUser->id);
        $revokeRes->assertSessionHas('message');

        $this->assertNull(User::find($secUser->id), 'Secondary admin must be removed upon revocation');
    }
}

