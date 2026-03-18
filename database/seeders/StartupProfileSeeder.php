<?php

namespace Database\Seeders;

use App\Models\StartupProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class StartupProfileSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_IN');

        $states = [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh',
            'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka',
            'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram',
            'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu',
            'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal',
            'Delhi', 'Chandigarh',
        ];

        $stages = ['Ideation', 'Validation', 'Early Stage', 'Growth', 'Scaling'];

        $focusAreas = [
            'AgriTech', 'EdTech', 'FinTech', 'HealthTech', 'CleanTech',
            'E-Commerce', 'AI/ML', 'IoT', 'Logistics', 'SaaS',
            'FoodTech', 'HRTech', 'LegalTech', 'PropTech', 'TravelTech',
        ];

        $fundTypes = ['Bootstrapped', 'Angel', 'Seed', 'Series A', 'Series B', 'Grant', 'Other'];

        $genders = ['Male', 'Female', 'Other'];

        // Get existing startup users or create new ones to attach profiles to
        $startupUsers = User::where('role', 'startup')->pluck('id')->toArray();

        // We need 100 profiles — create extra startup users if needed
        $needed = 100 - count($startupUsers);
        if ($needed > 0) {
            for ($i = 1; $i <= $needed; $i++) {
                $user = User::create([
                    'name'        => $faker->name(),
                    'email'       => 'startup_extra' . $i . '_' . time() . '@demo.com',
                    'password'    => bcrypt('Demo@1234'),
                    'role'        => 'startup',
                    'is_verified' => true,
                ]);
                $startupUsers[] = $user->id;
            }
        }

        // Shuffle and take 100
        shuffle($startupUsers);
        $userIds = array_slice($startupUsers, 0, 100);

        // Remove existing profiles for these users to avoid duplicates
        StartupProfile::whereIn('user_id', $userIds)->delete();

        foreach ($userIds as $userId) {
            $hasCoFounder = $faker->boolean(60);
            $coFounders   = [];

            if ($hasCoFounder) {
                $cfCount = $faker->numberBetween(1, 3);
                for ($c = 0; $c < $cfCount; $c++) {
                    $coFounders[] = [
                        'name'       => $faker->name(),
                        'gender'     => $faker->randomElement($genders),
                        'email'      => $faker->unique()->safeEmail(),
                        'contact'    => '9' . $faker->numerify('#########'),
                        'role'       => $faker->randomElement(['CTO', 'COO', 'CMO', 'CFO', 'CPO', 'Head of Sales']),
                        'background' => $faker->sentences(3, true),
                    ];
                }
            }

            StartupProfile::create([
                'user_id'             => $userId,

                // Founder
                'founder_name'        => $faker->name(),
                'founder_gender'      => $faker->randomElement($genders),
                'founder_email'       => $faker->safeEmail(),
                'founder_contact'     => '9' . $faker->numerify('#########'),
                'founder_background'  => $faker->paragraph(3),

                // Co-founders
                'co_founders'         => empty($coFounders) ? null : $coFounders,

                // Startup Details
                'company_name'        => $faker->company() . ' ' . $faker->randomElement(['Technologies', 'Solutions', 'Ventures', 'Labs', 'Innovations']),
                'startup_stage'       => $faker->randomElement($stages),
                'state'               => $faker->randomElement($states),
                'city'                => $faker->city(),
                'team_size'           => $faker->numberBetween(2, 150),
                'focus_areas'         => $faker->randomElement($focusAreas),
                'product_description' => $faker->paragraphs(2, true),
                'problem_addressed'   => $faker->paragraph(2),
                'unique_idea'         => $faker->paragraph(2),
                'key_ip'              => $faker->randomElement(['Patent Pending', 'Registered Trademark', 'Trade Secret', 'Copyright', 'None']),
                'revenue_last_fy'     => $faker->randomFloat(2, 0, 5000000),
                'total_revenue'       => $faker->randomFloat(2, 0, 10000000),
                'market_size'         => '₹' . $faker->numberBetween(100, 50000) . ' Crore',
                'competitors'         => implode(', ', $faker->words(3)),
                'business_model'      => $faker->randomElement(['B2B', 'B2C', 'B2B2C', 'SaaS', 'Marketplace', 'Subscription', 'Freemium']),
                'incorporation_date'  => $faker->dateTimeBetween('-5 years', '-6 months')->format('Y-m-d'),
                'dipp_number'         => 'DIPP' . $faker->numerify('######'),
                'incubated_at'        => $faker->boolean(40) ? $faker->randomElement(['IIT Delhi', 'IIM Ahmedabad', 'T-Hub', 'NASSCOM', 'Startup India', 'CIIE.CO', 'NSRCEL']) : null,
                'govt_grant_name'     => $faker->boolean(30) ? $faker->randomElement(['Startup India Seed Fund', 'BIRAC Grant', 'DST NIDHI', 'MSME Grant', 'TIDE 2.0']) : null,
                'govt_grant_amount'   => $faker->boolean(30) ? $faker->randomFloat(2, 100000, 5000000) : null,

                // Investment
                'fund_raised'         => $faker->boolean(50) ? $faker->randomFloat(2, 0, 10000000) : null,
                'fund_type'           => $faker->boolean(50) ? $faker->randomElement($fundTypes) : null,
                'capital_seeking'     => $faker->randomFloat(2, 500000, 50000000),
                'fund_utilization_pdf'          => null,
                'pitch_deck_pdf'                => null,
                'incorporation_certificate_pdf' => null,

                // Social
                'website'   => $faker->boolean(60) ? 'https://www.' . $faker->domainName() : null,
                'linkedin'  => $faker->boolean(50) ? 'https://linkedin.com/company/' . $faker->slug() : null,
                'instagram' => $faker->boolean(30) ? 'https://instagram.com/' . $faker->userName() : null,
                'facebook'  => $faker->boolean(30) ? 'https://facebook.com/' . $faker->userName() : null,
                'twitter'   => $faker->boolean(30) ? 'https://twitter.com/' . $faker->userName() : null,

                'declaration'  => true,
                'can_approved' => 0,
            ]);
        }

        $this->command->info('✅ 100 startup profiles seeded successfully.');
    }
}
