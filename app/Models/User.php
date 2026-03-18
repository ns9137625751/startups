<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_verified',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at'    => 'datetime',
            'password'          => 'hashed',
            'is_verified'       => 'boolean',
        ];
    }

    public function dashboardRoute(): string
    {
        return match($this->role) {
            'super_admin'      => route('dashboard.super-admin.index'),
            'investor'         => route('dashboard.investor.index'),
            'mentor'           => route('dashboard.mentor.index'),
            'incubator'        => route('dashboard.incubator.index'),
            'government_body'  => route('dashboard.government.index'),
            'industry_expert'  => route('dashboard.industry-expert.index'),
            default            => route('dashboard.startup.index'),
        };
    }

    public static function roles(): array
    {
        return [
            'startup'         => 'Startup',
            'investor'        => 'Investor',
            'mentor'          => 'Mentor',
            'incubator'       => 'Incubator / Accelerator',
            'government_body' => 'Government Body',
            'industry_expert' => 'Industry Expert',
            'super_admin'     => 'Super Admin',
        ];
    }
}
