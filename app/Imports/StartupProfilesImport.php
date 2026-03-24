<?php

namespace App\Imports;

use App\Models\StartupProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class StartupProfilesImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;

    // Column index map (0-based), matches StartupProfilesTemplateExport headings:
    // 0=name, 1=mobile, 2=address, 3=logo, 4=founder_name, 5=founder_gender,
    // 6=founder_email, 7=founder_contact, 8=founder_background, 9=co_founders,
    // 10=company_name, 11=startup_stage, 12=state, 13=city, 14=team_size,
    // 15=focus_areas, 16=product_description, 17=problem_addressed, 18=unique_idea,
    // 19=key_ip, 20=revenue_last_fy, 21=total_revenue, 22=market_size,
    // 23=competitors, 24=business_model, 25=incorporation_date, 26=dipp_number,
    // 27=incubated_at, 28=govt_grant_name, 29=govt_grant_amount, 30=fund_raised,
    // 31=fund_type, 32=capital_seeking, 33=fund_utilization_pdf, 34=pitch_deck_pdf,
    // 35=incorporation_certificate_pdf, 36=website, 37=linkedin, 38=instagram,
    // 39=facebook, 40=twitter, 41=declaration, 42=can_approved

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $founderEmail = $this->val($row[6] ?? null);
        $founderName  = $this->val($row[4] ?? null);
        $companyName  = $this->val($row[10] ?? null);
        $city         = $this->val($row[13] ?? null);
        $state        = $this->val($row[12] ?? null);

        // Skip if required fields are missing
        if (!$founderEmail || !$founderName || !$companyName || !$city || !$state) {
            return null;
        }

        try {
            $user = User::firstOrCreate(
                ['email' => $founderEmail],
                [
                    'name'        => $founderName,
                    'password'    => Hash::make('12345678'),
                    'role'        => 'startup',
                    'is_verified' => false,
                ]
            );

            $startupData = [
                'user_id'                        => $user->id,
                'name'                           => $this->val($row[0] ?? null) ?? $founderName,
                'mobile'                         => $this->val($row[1] ?? null) ?? $this->val($row[7] ?? null) ?? 'N/A',
                'address'                        => $this->val($row[2] ?? null) ?? 'N/A',
                'logo'                           => null,
                'founder_name'                   => $founderName,
                'founder_gender'                 => $this->val($row[5] ?? null) ?? 'N/A',
                'founder_email'                  => $founderEmail,
                'founder_contact'                => $this->val($row[7] ?? null) ?? 'N/A',
                'founder_background'             => $this->val($row[8] ?? null) ?? 'N/A',
                'co_founders'                    => $this->parseCoFounders($row[9] ?? null),
                'company_name'                   => $companyName,
                'startup_stage'                  => $this->val($row[11] ?? null) ?? 'Ideation',
                'state'                          => $state,
                'city'                           => $city,
                'team_size'                      => max(1, (int) ($row[14] ?? 1)),
                'focus_areas'                    => $this->val($row[15] ?? null) ?? 'N/A',
                'product_description'            => $this->val($row[16] ?? null) ?? 'N/A',
                'problem_addressed'              => $this->val($row[17] ?? null) ?? 'N/A',
                'unique_idea'                    => $this->val($row[18] ?? null) ?? 'N/A',
                'key_ip'                         => $this->val($row[19] ?? null) ?? 'N/A',
                'revenue_last_fy'                => (float) ($row[20] ?? 0),
                'total_revenue'                  => (float) ($row[21] ?? 0),
                'market_size'                    => $this->val($row[22] ?? null) ?? 'N/A',
                'competitors'                    => $this->val($row[23] ?? null) ?? 'N/A',
                'business_model'                 => $this->val($row[24] ?? null) ?? 'N/A',
                'incorporation_date'             => $this->parseDate($row[25] ?? null),
                'dipp_number'                    => $this->val($row[26] ?? null) ?? 'N/A',
                'incubated_at'                   => $this->val($row[27] ?? null),
                'govt_grant_name'                => $this->val($row[28] ?? null),
                'govt_grant_amount'              => $this->floatOrNull($row[29] ?? null),
                'fund_raised'                    => $this->floatOrNull($row[30] ?? null),
                'fund_type'                      => $this->val($row[31] ?? null),
                'capital_seeking'                => (float) ($row[32] ?? 0),
                'fund_utilization_pdf'           => null,
                'pitch_deck_pdf'                 => null,
                'incorporation_certificate_pdf'  => null,
                'website'                        => $this->val($row[36] ?? null),
                'linkedin'                       => $this->val($row[37] ?? null),
                'instagram'                      => $this->val($row[38] ?? null),
                'facebook'                       => $this->val($row[39] ?? null),
                'twitter'                        => $this->val($row[40] ?? null),
                'declaration'                    => true,
                'can_approved'                   => 1,
            ];

            return StartupProfile::updateOrCreate(
                ['user_id' => $user->id],
                $startupData
            );

        } catch (\Exception $e) {
            Log::error('StartupProfilesImport row failed: ' . $e->getMessage(), ['row' => $row]);
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

    private function floatOrNull($value): ?float
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }
        return (float) $value;
    }

    private function parseDate($value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }
        try {
            // Handle Excel numeric date serial
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseCoFounders($value): ?array
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }
        $decoded = json_decode((string) $value, true);
        return (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : null;
    }
}
