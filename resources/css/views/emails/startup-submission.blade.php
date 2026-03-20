@component('mail::message')
# Startup Profile Submitted Successfully 🎉

Dear **{{ $profile->founder_name }}**,

Thank you for submitting your startup profile for **{{ $profile->company_name }}**. We have received your application and it is currently under review.

@component('mail::panel')
**Company:** {{ $profile->company_name }}
**Stage:** {{ $profile->startup_stage }}
**DIPP No:** {{ $profile->dipp_number }}
**Submitted On:** {{ $profile->created_at->format('d M Y, h:i A') }}
@endcomponent

Our team will review your details and get back to you shortly. You will be notified once your profile is approved.

@component('mail::button', ['url' => url('/dashboard/startup'), 'color' => 'green'])
Go to Dashboard
@endcomponent

Thanks,
**i-HUB Team**
@endcomponent
