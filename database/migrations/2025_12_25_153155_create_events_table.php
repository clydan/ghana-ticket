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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->unsignedBigInteger('organizer_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('venue_name');
            $table->string('venue_address');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->unsignedInteger('duration')->comment('Duration in minutes');
            $table->enum('status', [
                'DRAFT',
                'PUBLISHED',
                'CANCELLED',
                'COMPLETED'
            ])->default('DRAFT');
            $table->unsignedInteger('max_capacity')->nullable();
            $table->unsignedInteger('expected_attendees')->nullable();
            $table->decimal('sales_target', 15, 2)->nullable();
            $table->dateTime('early_bird_deadline')->nullable();
            $table->text('refund_policy')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
