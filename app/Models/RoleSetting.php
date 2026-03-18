<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleSetting extends Model
{
    protected $fillable = ['role', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    // Returns array of active role keys
    public static function activeRoles(): array
    {
        return static::where('is_active', true)->pluck('role')->toArray();
    }

    // Check if a specific role is active
    public static function isActive(string $role): bool
    {
        $setting = static::where('role', $role)->first();
        return $setting ? $setting->is_active : true;
    }
}
