<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MentorProfilesTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return ['name', 'email', 'mobile_number', 'organization', 'designation', 'brief', 'domain', 'expertise'];
    }

    public function array(): array
    {
        return [
            [
                'Rajesh Kumar',
                'rajesh.kumar@example.com',
                '9876543210',
                'TechVentures India',
                'Senior Mentor',
                'Experienced entrepreneur with 15+ years in SaaS and product development.',
                'SaaS, Fintech',
                'Product Strategy, Fundraising',
            ],
            [
                'Priya Sharma',
                'priya.sharma@example.com',
                '9123456780',
                'GreenFuture Foundation',
                'Lead Advisor',
                'Sustainability expert helping startups build ESG-compliant business models.',
                'Cleantech, ESG, Sustainability',
                'Business Development, ESG Compliance',
            ],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
