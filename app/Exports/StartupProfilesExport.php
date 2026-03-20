<?php

namespace App\Exports;

use App\Models\StartupProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StartupProfilesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return StartupProfile::with('user')->get();
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

    public function map($startupProfile): array
    {
        return [
            $startupProfile->name,
            $startupProfile->mobile,
            $startupProfile->address,
            $startupProfile->logo,
            $startupProfile->founder_name,
            $startupProfile->founder_gender,
            $startupProfile->founder_email,
            $startupProfile->founder_contact,
            $startupProfile->founder_background,
            is_array($startupProfile->co_founders) ? json_encode($startupProfile->co_founders) : $startupProfile->co_founders,
            $startupProfile->company_name,
            $startupProfile->startup_stage,
            $startupProfile->state,
            $startupProfile->city,
            $startupProfile->team_size,
            $startupProfile->focus_areas,
            $startupProfile->product_description,
            $startupProfile->problem_addressed,
            $startupProfile->unique_idea,
            $startupProfile->key_ip,
            $startupProfile->revenue_last_fy,
            $startupProfile->total_revenue,
            $startupProfile->market_size,
            $startupProfile->competitors,
            $startupProfile->business_model,
            $startupProfile->incorporation_date ? $startupProfile->incorporation_date->format('Y-m-d') : '',
            $startupProfile->dipp_number,
            $startupProfile->incubated_at,
            $startupProfile->govt_grant_name,
            $startupProfile->govt_grant_amount,
            $startupProfile->fund_raised,
            $startupProfile->fund_type,
            $startupProfile->capital_seeking,
            $startupProfile->fund_utilization_pdf,
            $startupProfile->pitch_deck_pdf,
            $startupProfile->incorporation_certificate_pdf,
            $startupProfile->website,
            $startupProfile->linkedin,
            $startupProfile->instagram,
            $startupProfile->facebook,
            $startupProfile->twitter,
            $startupProfile->declaration ? 'true' : 'false',
            $startupProfile->can_approved,
        ];
    }
}