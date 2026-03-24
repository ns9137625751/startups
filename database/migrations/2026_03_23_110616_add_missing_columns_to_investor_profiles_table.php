<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('investor_profiles', 'portfolio_companies'))
                $table->text('portfolio_companies')->nullable()->after('investment_sectors');
            if (!Schema::hasColumn('investor_profiles', 'logo'))
                $table->string('logo')->nullable()->after('portfolio_companies');
            if (!Schema::hasColumn('investor_profiles', 'founder_img'))
                $table->string('founder_img')->nullable()->after('logo');
            if (!Schema::hasColumn('investor_profiles', 'city'))
                $table->string('city')->after('founder_img');
            if (!Schema::hasColumn('investor_profiles', 'state'))
                $table->string('state')->after('city');
            if (!Schema::hasColumn('investor_profiles', 'website'))
                $table->string('website')->nullable()->after('state');
            if (!Schema::hasColumn('investor_profiles', 'can_approved'))
                $table->tinyInteger('can_approved')->default(0)->after('website');
            if (!Schema::hasColumn('investor_profiles', 'created_at'))
                $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'portfolio_companies', 'logo', 'founder_img',
                'city', 'state', 'website', 'can_approved',
            ]);
        });
    }
};
