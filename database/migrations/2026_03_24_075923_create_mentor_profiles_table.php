<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('mobile_number')->default('N/A');
            $table->string('organization')->default('N/A');
            $table->string('designation')->default('N/A');
            $table->text('brief')->nullable();
            $table->json('domain')->nullable();
            $table->string('expertise')->nullable();
            $table->tinyInteger('can_approved')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_profiles');
    }
};
