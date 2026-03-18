<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            'AgriTech', 'EdTech', 'FinTech', 'HealthTech', 'CleanTech',
            'E-Commerce', 'AI / ML', 'IoT', 'Logistics', 'SaaS',
            'FoodTech', 'HRTech', 'LegalTech', 'PropTech', 'TravelTech',
            'CyberSecurity', 'BioTech', 'SpaceTech', 'GamingTech', 'RetailTech',
        ];

        foreach ($sectors as $sector) {
            Domain::firstOrCreate(['name' => $sector]);
        }

        $this->command->info('✅ Domains seeded successfully.');
    }
}
