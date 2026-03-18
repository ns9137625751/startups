<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'startup'         => 10,
            'investor'        => 10,
            'mentor'          => 10,
            'incubator'       => 10,
            'government_body' => 10,
            'industry_expert' => 10,
            'super_admin'     => 2,
        ];

        foreach ($roles as $role => $count) {
            for ($i = 1; $i <= $count; $i++) {
                $slug = str_replace('_', '', $role);
                User::create([
                    'name'        => fake()->name(),
                    'email'       => "{$slug}{$i}@demo.com",
                    'password'    => Hash::make('Demo@1234'),
                    'role'        => $role,
                    'is_verified' => true,
                ]);
            }
        }

        // One memorable super admin
        User::updateOrCreate(
            ['email' => 'admin@startupeco.in'],
            [
                'name'        => 'Super Admin',
                'password'    => Hash::make('Admin@1234'),
                'role'        => 'super_admin',
                'is_verified' => true,
            ]
        );
    }
}
