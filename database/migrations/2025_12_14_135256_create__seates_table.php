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
        Schema::create('_seates', function (Blueprint $table)
        {
            $table->id();
            $table->tinyInteger('Seat_number')->unsigned();
             $table->foreignId('bus_id')
              ->constrained('_bus')
              ->onDelete('cascade');
             $table->timestamps();
             $table->unique(['bus_id', 'seat_number']);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_seates');
    }
};
