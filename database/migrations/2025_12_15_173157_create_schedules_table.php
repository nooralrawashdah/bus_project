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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
              $table->dateTime('scheduled_start');
              $table->dateTime('scheduled_end');

             $table->foreignId('bus_id')
              ->constrained('_bus')
              ->onDelete('cascade');

               $table->foreignId('trip_id')
              ->constrained('trips')
              ->onDelete('cascade');

             $table->unique(['bus_id', 'scheduled_start', 'scheduled_end']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
