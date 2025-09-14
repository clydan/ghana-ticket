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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('business_name')->index()->unique();
            $table->string('address')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('business_category')->nullable();
            $table->string('business_type')->nullable();
            $table->string('business_email')->nullable()->index()->unique();
            $table->string('business_facebook_url')->nullable();
            $table->string('business_twitter_url')->nullable();
            $table->string('business_instagram_url')->nullable();
            $table->string('business_whatsapp_number')->nullable();
            $table->string('business_contact')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->text('business_description')->nullable();
            $table->string('business_code')->unique()->index();
            $table->string('activation_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
