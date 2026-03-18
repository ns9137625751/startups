<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StartupProfile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'mobile', 'address', 'logo', 'founder_name', 'founder_gender', 'founder_email', 'founder_contact',
        'founder_background', 'co_founders', 'company_name', 'startup_stage', 'state',
        'city', 'team_size', 'focus_areas', 'product_description', 'problem_addressed',
        'unique_idea', 'key_ip', 'revenue_last_fy', 'total_revenue', 'market_size',
        'competitors', 'business_model', 'incorporation_date', 'dipp_number',
        'incubated_at', 'govt_grant_name', 'govt_grant_amount', 'fund_raised',
        'fund_type', 'capital_seeking', 'fund_utilization_pdf', 'pitch_deck_pdf',
        'incorporation_certificate_pdf', 'website', 'linkedin', 'instagram',
        'facebook', 'twitter', 'declaration', 'can_approved',
    ];

    protected $casts = [
        'co_founders' => 'array',
        'declaration' => 'boolean',
        'incorporation_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
