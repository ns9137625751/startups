<?php

namespace App\Imports;

use App\Models\Domain;
use App\Models\InvestorProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class InvestorProfilesImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;

    // Start from row 2 (row 1 is the heading)
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $fundName  = $this->val($row[0] ?? null);
        $fundEmail = $this->val($row[1] ?? null);

        // Skip if only truly required fields are missing
        if (!$fundName || !$fundEmail) {
            return null;
        }

        $city  = $this->val($row[12] ?? null) ?? 'N/A';
        $state = $this->val($row[13] ?? null) ?? 'N/A';

        try {
            $user = User::firstOrCreate(
                ['email' => $fundEmail],
                [
                    'name'        => $fundName,
                    'password'    => Hash::make('12345678'),
                    'role'        => 'investor',
                    'is_verified' => false,
                ]
            );

            // If user already has an investor profile, skip
            if (InvestorProfile::where('user_id', $user->id)->exists()) {
                return null;
            }

            $investorData = [
                'user_id'               => $user->id,
                'fund_name'             => $fundName,
                'fund_email'            => $fundEmail,
                'fund_mobile_number'    => $this->val($row[2] ?? null) ?? 'N/A',
                'fund_brief'            => $this->val($row[3] ?? null) ?? 'N/A',
                'partner_name'          => $this->val($row[4] ?? null) ?? 'N/A',
                'partner_email'         => $this->val($row[5] ?? null) ?? $fundEmail,
                'partner_mobile_number' => $this->val($row[6] ?? null) ?? 'N/A',
                'ticket_size'           => $this->val($row[7] ?? null) ?? 'N/A',
                'investment_sectors'    => $this->parseSectors($row[8] ?? null),
                'portfolio_companies'   => $this->val($row[9] ?? null),
                'logo'                  => null,
                'founder_img'           => null,
                'city'                  => $city,
                'state'                 => $state,
                'website'               => $this->val($row[14] ?? null),
                'can_approved'          => 1,
            ];

            return InvestorProfile::create($investorData);

        } catch (\Exception $e) {
            Log::error('InvestorProfilesImport row failed: ' . $e->getMessage(), ['row' => $row]);
            return null;
        }
    }

    private function val($value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }
        return trim((string) $value);
    }

    private function parseSectors($data): array
    {
        $str = trim((string) ($data ?? ''));

        if ($str === '') {
            return [];
        }

        // Already a JSON array of IDs e.g. [1,2,3]
        $decoded = json_decode($str, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_map('intval', $decoded);
        }

        // Plain text names — may be newline-separated or comma-separated
        // Split on newlines first, then fallback to commas
        $parts = preg_split('/\r\n|\r|\n/', $str);
        if (count($parts) === 1) {
            $parts = explode(',', $str);
        }
        $ids = [];
        foreach ($parts as $part) {
            // Strip HTML entities, extra whitespace
            $name = trim(html_entity_decode(preg_replace('/\s+/', ' ', $part)));
            if ($name === '') continue;
            $domain = Domain::firstOrCreate(['name' => $name]);
            $ids[]  = $domain->id;
        }
        return $ids;
    }
}
