<?php

namespace App\Imports;

use App\Models\Domain;
use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

// Columns (0-based index):
// 0: name  1: email  2: mobile_number  3: organization
// 4: designation  5: brief  6: domain  7: expertise

class MentorProfilesImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $name  = $this->val($row[0] ?? null);
        $email = $this->val($row[1] ?? null);

        if (!$name || !$email) {
            return null;
        }

        try {
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'        => $name,
                    'password'    => Hash::make('12345678'),
                    'role'        => 'mentor',
                    'is_verified' => false,
                ]
            );

            if (MentorProfile::where('user_id', $user->id)->exists()) {
                return null;
            }

            return MentorProfile::create([
                'user_id'       => $user->id,
                'name'          => $name,
                'email'         => $email,
                'mobile_number' => $this->val($row[2] ?? null) ?? 'N/A',
                'organization'  => $this->val($row[3] ?? null) ?? 'N/A',
                'designation'   => $this->val($row[4] ?? null) ?? 'N/A',
                'brief'         => $this->val($row[5] ?? null),
                'domain'        => $this->parseDomains($row[6] ?? null),
                'expertise'     => $this->val($row[7] ?? null),
                'can_approved'  => 1,
            ]);

        } catch (\Exception $e) {
            Log::error('MentorProfilesImport row failed: ' . $e->getMessage(), ['row' => $row]);
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

    private function parseDomains($data): array
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

        // Split on newlines or commas, create missing domains
        $parts = preg_split('/[\r\n,]+/', $str);
        $ids   = [];
        foreach ($parts as $part) {
            $name = trim(html_entity_decode(preg_replace('/\s+/', ' ', $part)));
            if ($name === '' || strtolower($name) === 'n/a') continue;
            $domain = Domain::firstOrCreate(['name' => $name]);
            $ids[]  = $domain->id;
        }
        return $ids;
    }
}