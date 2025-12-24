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
        Schema::create('_bus_seat', function (Blueprint $table) {
            $table->foreignId('bus_id')
                ->constrained('_bus')
                ->onDelete('cascade');
            $table->foreignId('seat_id')
                ->constrained('_seates')
                ->onDelete('cascade');
          $table->primary(['bus_id', 'seat_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_bus_seat');
    }
};
