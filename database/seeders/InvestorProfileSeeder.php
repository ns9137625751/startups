<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\InvestorProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class InvestorProfileSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_IN');

        $states = [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh',
            'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka',
            'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya',
            'Odisha', 'Punjab', 'Rajasthan', 'Tamil Nadu', 'Telangana',
            'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Delhi', 'Chandigarh',
        ];

        $fundSuffixes = ['Ventures', 'Capital', 'Fund', 'Partners', 'Investments', 'Growth Fund', 'Angel Network'];

        // Ensure domains exist
        $this->call(DomainSeeder::class);
        $domainIds = Domain::pluck('id')->toArray();

        // Get or create investor users
        $investorUsers = User::where('role', 'investor')->pluck('id')->toArray();

        $needed = 100 - count($investorUsers);
        if ($needed > 0) {
            for ($i = 1; $i <= $needed; $i++) {
                $user = User::create([
                    'name'        => $faker->name(),
                    'email'       => 'investor_extra' . $i . '_' . time() . '@demo.com',
                    'password'    => bcrypt('Demo@1234'),
                    'role'        => 'investor',
                    'is_verified' => true,
                ]);
                $investorUsers[] = $user->id;
            }
        }

        shuffle($investorUsers);
        $userIds = array_slice($investorUsers, 0, 100);

        InvestorProfile::whereIn('user_id', $userIds)->delete();

        foreach ($userIds as $userId) {
            // Pick 1–4 random domain IDs
            $sectorCount   = $faker->numberBetween(1, 4);
            $sectorIds     = $faker->randomElements($domainIds, min($sectorCount, count($domainIds)));

            // Portfolio companies: 0–5 company names
            $portfolioCount     = $faker->numberBetween(0, 5);
            $portfolioCompanies = $portfolioCount > 0
                ? implode(', ', array_map(fn() => $faker->company(), range(1, $portfolioCount)))
                : null;

            InvestorProfile::create([
                'user_id'                => $userId,
                'fund_name'              => $faker->company() . ' ' . $faker->randomElement($fundSuffixes),
                'fund_email'             => $faker->companyEmail(),
                'fund_mobile_number'     => '9' . $faker->numerify('#########'),
                'fund_brief'             => $faker->paragraph(3),
                'partner_name'           => $faker->name(),
                'partner_email'          => $faker->safeEmail(),
                'partner_mobile_number'  => '9' . $faker->numerify('#########'),
                'ticket_size'            => $faker->randomElement([500000, 1000000, 2500000, 5000000, 10000000, 25000000, 50000000]),
                'investment_sectors'     => $sectorIds,
                'portfolio_companies'    => $portfolioCompanies,
                'logo'                   => null,
                'founder_img'            => null,
                'city'                   => $faker->city(),
                'state'                  => $faker->randomElement($states),
                'website'                => $faker->boolean(60) ? 'https://www.' . $faker->domainName() : null,
                'can_approved'           => 0,
            ]);
        }

        $this->command->info('✅ 100 investor profiles seeded successfully.');
    }
}
