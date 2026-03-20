<?php

namespace App\Imports;

use App\Models\StartupProfile;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StartupProfilesImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $row['founder_email']],
                [
                    'name' => $row['founder_name'],
                    'password' => Hash::make('12345678'),
                    'role' => 'startup',
                    'is_verified' => false,
                ]
            );

            // Prepare startup profile data
            $startupData = [
                'user_id' => $user->id,
                'name' => $row['name'] ?? $row['founder_name'],
                'mobile' => $row['mobile'] ?? $row['founder_contact'],
                'address' => $row['address'] ?? '',
                'logo' => $row['logo'] ?? null,
                'founder_name' => $row['founder_name'],
                'founder_gender' => $row['founder_gender'],
                'founder_email' => $row['founder_email'],
                'founder_contact' => $row['founder_contact'],
                'founder_background' => $row['founder_background'],
                'co_founders' => $this->parseCoFounders($row['co_founders'] ?? null),
                'company_name' => $row['company_name'],
                'startup_stage' => $row['startup_stage'],
                'state' => $row['state'],
                'city' => $row['city'],
                'team_size' => (int) $row['team_size'],
                'focus_areas' => $row['focus_areas'],
                'product_description' => $row['product_description'],
                'problem_addressed' => $row['problem_addressed'],
                'unique_idea' => $row['unique_idea'],
                'key_ip' => $row['key_ip'],
                'revenue_last_fy' => (float) ($row['revenue_last_fy'] ?? 0),
                'total_revenue' => (float) ($row['total_revenue'] ?? 0),
                'market_size' => $row['market_size'],
                'competitors' => $row['competitors'],
                'business_model' => $row['business_model'],
                'incorporation_date' => $this->parseDate($row['incorporation_date'] ?? null),
                'dipp_number' => $row['dipp_number'],
                'incubated_at' => $row['incubated_at'] ?? null,
                'govt_grant_name' => $row['govt_grant_name'] ?? null,
                'govt_grant_amount' => $row['govt_grant_amount'] ? (float) $row['govt_grant_amount'] : null,
                'fund_raised' => $row['fund_raised'] ? (float) $row['fund_raised'] : null,
                'fund_type' => $row['fund_type'] ?? null,
                'capital_seeking' => (float) ($row['capital_seeking'] ?? 0),
                'fund_utilization_pdf' => $row['fund_utilization_pdf'] ?? null,
                'pitch_deck_pdf' => $row['pitch_deck_pdf'] ?? null,
                'incorporation_certificate_pdf' => $row['incorporation_certificate_pdf'] ?? null,
                'website' => $row['website'] ?? null,
                'linkedin' => $row['linkedin'] ?? null,
                'instagram' => $row['instagram'] ?? null,
                'facebook' => $row['facebook'] ?? null,
                'twitter' => $row['twitter'] ?? null,
                'declaration' => true, // Default to true
                'can_approved' => 1, // Default to approved
            ];

            // Create or update startup profile
            StartupProfile::updateOrCreate(
                ['user_id' => $user->id],
                $startupData
            );
        }
    }

    private function parseCoFounders($coFoundersData)
    {
        if (empty($coFoundersData)) {
            return null;
        }

        // If it's already JSON, decode it
        if (is_string($coFoundersData) && $this->isJson($coFoundersData)) {
            return json_decode($coFoundersData, true);
        }

        return null;
    }

    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function rules(): array
    {
        return [
            'founder_name' => 'required|string',
            'founder_email' => 'required|email',
            'founder_contact' => 'required|string',
            'company_name' => 'required|string',
            'startup_stage' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'team_size' => 'required|numeric|min:1',
            'focus_areas' => 'required|string',
            'product_description' => 'required|string',
            'problem_addressed' => 'required|string',
            'unique_idea' => 'required|string',
            'key_ip' => 'required|string',
            'market_size' => 'required|string',
            'competitors' => 'required|string',
            'business_model' => 'required|string',
            'dipp_number' => 'required|string',
        ];
    }
}