<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StartupProfilesTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        // Return empty array for template
        return [];
    }

    public function headings(): array
    {
        return [
            'name', 'mobile', 'address', 'logo', 'founder_name', 'founder_gender', 'founder_email', 'founder_contact',
            'founder_background', 'co_founders', 'company_name', 'startup_stage', 'state',
            'city', 'team_size', 'focus_areas', 'product_description', 'problem_addressed',
            'unique_idea', 'key_ip', 'revenue_last_fy', 'total_revenue', 'market_size',
            'competitors', 'business_model', 'incorporation_date', 'dipp_number',
            'incubated_at', 'govt_grant_name', 'govt_grant_amount', 'fund_raised',
            'fund_type', 'capital_seeking', 'fund_utilization_pdf', 'pitch_deck_pdf',
            'incorporation_certificate_pdf', 'website', 'linkedin', 'instagram',
            'facebook', 'twitter', 'declaration', 'can_approved',
        ];
    }
}