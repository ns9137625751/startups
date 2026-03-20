<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvestorProfilesTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        // Return empty array for template
        return [];
    }

    public function headings(): array
    {
        return [
            'fund_name', 'fund_email', 'fund_mobile_number', 'fund_brief',
            'partner_name', 'partner_email', 'partner_mobile_number',
            'ticket_size', 'investment_sectors', 'portfolio_companies',
            'logo', 'founder_img', 'city', 'state', 'website', 'can_approved',
        ];
    }
}