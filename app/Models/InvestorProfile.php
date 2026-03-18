<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model
{
    protected $fillable = [
        'user_id', 'fund_name', 'fund_email', 'fund_mobile_number', 'fund_brief',
        'partner_name', 'partner_email', 'partner_mobile_number',
        'ticket_size', 'investment_sectors', 'portfolio_companies',
        'logo', 'founder_img', 'city', 'state', 'website', 'can_approved',
    ];

    protected $casts = [
        'investment_sectors' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
