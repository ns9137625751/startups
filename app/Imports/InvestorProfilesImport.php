<?php

namespace App\Imports;

use App\Models\InvestorProfile;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvestorProfilesImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $row['fund_email']],
                [
                    'name' => $row['fund_name'],
                    'password' => Hash::make('12345678'),
                    'role' => 'investor',
                    'is_verified' => false,
                ]
            );

            // Prepare investor profile data
            $investorData = [
                'user_id' => $user->id,
                'fund_name' => $row['fund_name'],
                'fund_email' => $row['fund_email'],
                'fund_mobile_number' => $row['fund_mobile_number'],
                'fund_brief' => $row['fund_brief'],
                'partner_name' => $row['partner_name'],
                'partner_email' => $row['partner_email'],
                'partner_mobile_number' => $row['partner_mobile_number'],
                'ticket_size' => (float) ($row['ticket_size'] ?? 0),
                'investment_sectors' => $this->parseInvestmentSectors($row['investment_sectors'] ?? null),
                'portfolio_companies' => $row['portfolio_companies'] ?? null,
                'logo' => $row['logo'] ?? null,
                'founder_img' => $row['founder_img'] ?? null,
                'city' => $row['city'],
                'state' => $row['state'],
                'website' => $row['website'] ?? null,
                'can_approved' => 1, // Default to approved
            ];

            // Create or update investor profile
            InvestorProfile::updateOrCreate(
                ['user_id' => $user->id],
                $investorData
            );
        }
    }

    private function parseInvestmentSectors($sectorsData)
    {
        if (empty($sectorsData)) {
            return [];
        }

        // If it's already JSON, decode it
        if (is_string($sectorsData) && $this->isJson($sectorsData)) {
            return json_decode($sectorsData, true);
        }

        // If it's comma-separated values, convert to array of integers
        if (is_string($sectorsData)) {
            $sectors = explode(',', $sectorsData);
            return array_map('intval', array_filter(array_map('trim', $sectors)));
        }

        return [];
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function rules(): array
    {
        return [
            'fund_name' => 'required|string',
            'fund_email' => 'required|email',
            'fund_mobile_number' => 'required|string',
            'fund_brief' => 'required|string',
            'partner_name' => 'required|string',
            'partner_email' => 'required|email',
            'partner_mobile_number' => 'required|string',
            'ticket_size' => 'required|numeric|min:0',
            'city' => 'required|string',
            'state' => 'required|string',
        ];
    }
}