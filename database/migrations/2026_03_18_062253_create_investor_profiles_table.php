<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Fund details
            $table->string('fund_name');
            $table->string('fund_email');
            $table->string('fund_mobile_number');
            $table->text('fund_brief');

            // Partner details
            $table->string('partner_name');
            $table->string('partner_email');
            $table->string('partner_mobile_number');

            // Investment info
            $table->decimal('ticket_size', 15, 2);                // in INR
            $table->json('investment_sectors');                    // array of domain IDs

            // Portfolio
            $table->text('portfolio_companies')->nullable();       // comma-separated or text

            // Media
            $table->string('logo')->nullable();                    // stored path
            $table->string('founder_img')->nullable();             // stored path

            // Location
            $table->string('city');
            $table->string('state');

            // Social
            $table->string('website')->nullable();

            $table->tinyInteger('can_approved')->default(0);       // 0=pending,1=approved,2=rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_profiles');
    }
};
