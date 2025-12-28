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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('ticket_type_id');
            $table->float('price');
            $table->unsignedInteger('quantity_available');
            $table->unsignedInteger('quantity_sold')->default(0);
            $table->dateTime('sales_start_datetime');
            $table->dateTime('sales_end_datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
