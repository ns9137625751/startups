<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('startup_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Founder
            $table->string('founder_name');
            $table->string('founder_gender');
            $table->string('founder_email');
            $table->string('founder_contact');
            $table->text('founder_background');

            // Co-founders (JSON array of objects)
            $table->json('co_founders')->nullable();

            // Startup Details
            $table->string('company_name');
            $table->string('startup_stage');
            $table->string('state');
            $table->string('city');
            $table->unsignedInteger('team_size');
            $table->string('focus_areas');
            $table->text('product_description');
            $table->text('problem_addressed');
            $table->text('unique_idea');
            $table->text('key_ip');
            $table->decimal('revenue_last_fy', 15, 2)->default(0);
            $table->decimal('total_revenue', 15, 2)->default(0);
            $table->text('market_size');
            $table->text('competitors');
            $table->text('business_model');
            $table->date('incorporation_date');
            $table->string('dipp_number');
            $table->string('incubated_at')->nullable();
            $table->string('govt_grant_name')->nullable();
            $table->decimal('govt_grant_amount', 15, 2)->nullable();

            // Investment
            $table->decimal('fund_raised', 15, 2)->nullable();
            $table->string('fund_type')->nullable();
            $table->decimal('capital_seeking', 15, 2);
            $table->string('fund_utilization_pdf')->nullable();
            $table->string('pitch_deck_pdf')->nullable();
            $table->string('incorporation_certificate_pdf')->nullable();

            // Social
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();

            $table->boolean('declaration')->default(false);
            $table->tinyInteger('can_approved')->default(0); // 0=pending, 1=approved, 2=rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};
