<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('startup_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('startup_profiles', 'company_name'))
                $table->string('company_name')->after('co_founders');
            if (!Schema::hasColumn('startup_profiles', 'startup_stage'))
                $table->string('startup_stage')->after('company_name');
            if (!Schema::hasColumn('startup_profiles', 'state'))
                $table->string('state')->after('startup_stage');
            if (!Schema::hasColumn('startup_profiles', 'city'))
                $table->string('city')->after('state');
            if (!Schema::hasColumn('startup_profiles', 'team_size'))
                $table->unsignedInteger('team_size')->after('city');
            if (!Schema::hasColumn('startup_profiles', 'focus_areas'))
                $table->string('focus_areas')->after('team_size');
            if (!Schema::hasColumn('startup_profiles', 'product_description'))
                $table->text('product_description')->after('focus_areas');
            if (!Schema::hasColumn('startup_profiles', 'problem_addressed'))
                $table->text('problem_addressed')->after('product_description');
            if (!Schema::hasColumn('startup_profiles', 'unique_idea'))
                $table->text('unique_idea')->after('problem_addressed');
            if (!Schema::hasColumn('startup_profiles', 'key_ip'))
                $table->text('key_ip')->after('unique_idea');
            if (!Schema::hasColumn('startup_profiles', 'revenue_last_fy'))
                $table->decimal('revenue_last_fy', 15, 2)->default(0)->after('key_ip');
            if (!Schema::hasColumn('startup_profiles', 'total_revenue'))
                $table->decimal('total_revenue', 15, 2)->default(0)->after('revenue_last_fy');
            if (!Schema::hasColumn('startup_profiles', 'market_size'))
                $table->text('market_size')->after('total_revenue');
            if (!Schema::hasColumn('startup_profiles', 'competitors'))
                $table->text('competitors')->after('market_size');
            if (!Schema::hasColumn('startup_profiles', 'business_model'))
                $table->text('business_model')->after('competitors');
            if (!Schema::hasColumn('startup_profiles', 'incorporation_date'))
                $table->date('incorporation_date')->after('business_model');
            if (!Schema::hasColumn('startup_profiles', 'dipp_number'))
                $table->string('dipp_number')->after('incorporation_date');
            if (!Schema::hasColumn('startup_profiles', 'incubated_at'))
                $table->string('incubated_at')->nullable()->after('dipp_number');
            if (!Schema::hasColumn('startup_profiles', 'govt_grant_name'))
                $table->string('govt_grant_name')->nullable()->after('incubated_at');
            if (!Schema::hasColumn('startup_profiles', 'govt_grant_amount'))
                $table->decimal('govt_grant_amount', 15, 2)->nullable()->after('govt_grant_name');
            if (!Schema::hasColumn('startup_profiles', 'fund_raised'))
                $table->decimal('fund_raised', 15, 2)->nullable()->after('govt_grant_amount');
            if (!Schema::hasColumn('startup_profiles', 'fund_type'))
                $table->string('fund_type')->nullable()->after('fund_raised');
            if (!Schema::hasColumn('startup_profiles', 'capital_seeking'))
                $table->decimal('capital_seeking', 15, 2)->default(0)->after('fund_type');
            if (!Schema::hasColumn('startup_profiles', 'fund_utilization_pdf'))
                $table->string('fund_utilization_pdf')->nullable()->after('capital_seeking');
            if (!Schema::hasColumn('startup_profiles', 'pitch_deck_pdf'))
                $table->string('pitch_deck_pdf')->nullable()->after('fund_utilization_pdf');
            if (!Schema::hasColumn('startup_profiles', 'incorporation_certificate_pdf'))
                $table->string('incorporation_certificate_pdf')->nullable()->after('pitch_deck_pdf');
            if (!Schema::hasColumn('startup_profiles', 'website'))
                $table->string('website')->nullable()->after('incorporation_certificate_pdf');
            if (!Schema::hasColumn('startup_profiles', 'linkedin'))
                $table->string('linkedin')->nullable()->after('website');
            if (!Schema::hasColumn('startup_profiles', 'instagram'))
                $table->string('instagram')->nullable()->after('linkedin');
            if (!Schema::hasColumn('startup_profiles', 'facebook'))
                $table->string('facebook')->nullable()->after('instagram');
            if (!Schema::hasColumn('startup_profiles', 'twitter'))
                $table->string('twitter')->nullable()->after('facebook');
            if (!Schema::hasColumn('startup_profiles', 'declaration'))
                $table->boolean('declaration')->default(false)->after('twitter');
            if (!Schema::hasColumn('startup_profiles', 'can_approved'))
                $table->tinyInteger('can_approved')->default(0)->after('declaration');
            if (!Schema::hasColumn('startup_profiles', 'created_at'))
                $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('startup_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'company_name', 'startup_stage', 'state', 'city', 'team_size',
                'focus_areas', 'product_description', 'problem_addressed', 'unique_idea',
                'key_ip', 'revenue_last_fy', 'total_revenue', 'market_size', 'competitors',
                'business_model', 'incorporation_date', 'dipp_number', 'incubated_at',
                'govt_grant_name', 'govt_grant_amount', 'fund_raised', 'fund_type',
                'capital_seeking', 'fund_utilization_pdf', 'pitch_deck_pdf',
                'incorporation_certificate_pdf', 'website', 'linkedin', 'instagram',
                'facebook', 'twitter', 'declaration', 'can_approved',
            ]);
        });
    }
};
