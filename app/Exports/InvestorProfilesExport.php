<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\InvestorProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvestorProfilesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return InvestorProfile::with('user')->get();
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

    public function map($investorProfile): array
    {
        return [
            $investorProfile->fund_name,
            $investorProfile->fund_email,
            $investorProfile->fund_mobile_number,
            $investorProfile->fund_brief,
            $investorProfile->partner_name,
            $investorProfile->partner_email,
            $investorProfile->partner_mobile_number,
            $investorProfile->ticket_size,
            Domain::whereIn('id', $investorProfile->investment_sectors ?? [])->pluck('name')->implode(', '),
            $investorProfile->portfolio_companies,
            $investorProfile->logo,
            $investorProfile->founder_img,
            $investorProfile->city,
            $investorProfile->state,
            $investorProfile->website,
            $investorProfile->can_approved,
        ];
    }
}