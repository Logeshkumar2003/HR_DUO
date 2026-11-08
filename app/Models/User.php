<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if user is the designated permanent Main Admin
     * Only the designated email address has Main Admin authority.
     */
    public function isMainAdmin(): bool
    {
        $mainAdminEmail = strtolower(config('admin.main_admin_email', 'Nitta.prasanthi19@gmail.com'));
        return strtolower(trim($this->email)) === $mainAdminEmail;
    }

    /**
     * Check if user is a Secondary Admin
     */
    public function isSecondaryAdmin(): bool
    {
        return $this->role === 'secondary_admin' && !$this->isMainAdmin();
    }

    /**
     * Check if user has any administrative privileges (Main Admin or Secondary Admin)
     */
    public function isAdmin(): bool
    {
        return $this->isMainAdmin() || $this->isSecondaryAdmin();
    }
}
