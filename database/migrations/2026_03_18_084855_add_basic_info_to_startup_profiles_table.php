<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('startup_profiles', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('founder_background');
            $table->text('address')->nullable()->after('mobile');
            $table->string('logo')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('startup_profiles', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'address', 'logo']);
        });
    }
};
