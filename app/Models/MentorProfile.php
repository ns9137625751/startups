<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'mobile_number',
        'organization', 'designation', 'brief',
        'domain', 'expertise', 'can_approved',
    ];

    protected $casts = [
        'domain' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
