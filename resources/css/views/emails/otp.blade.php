<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Inter, Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
        .wrap { max-width: 480px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #0d1b2a, #1F3C88); padding: 32px 40px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; font-weight: 700; }
        .header span { color: #57BD68; }
        .body { padding: 36px 40px; }
        .body p { color: #4b5563; font-size: 14px; line-height: 1.7; margin: 0 0 16px; }
        .otp-box { background: #f4fbf6; border: 2px dashed #57BD68; border-radius: 10px; text-align: center; padding: 20px; margin: 24px 0; }
        .otp-box .otp { font-size: 36px; font-weight: 800; letter-spacing: 10px; color: #1a1a2e; }
        .otp-box .exp { font-size: 12px; color: #6b7280; margin-top: 6px; }
        .footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <h1>Startup<span>Eco</span></h1>
        </div>
        <div class="body">
            <p>Hi <strong>{{ $userName }}</strong>,</p>
            <p>Thank you for registering on <strong>StartupEco</strong>. Use the OTP below to verify your email address.</p>
            <div class="otp-box">
                <div class="otp">{{ $otp }}</div>
                <div class="exp">This OTP expires in <strong>10 minutes</strong></div>
            </div>
            <p>If you did not create an account, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} StartupEco. All rights reserved.
        </div>
    </div>
</body>
</html>
