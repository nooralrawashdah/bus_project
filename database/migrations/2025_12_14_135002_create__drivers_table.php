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
        Schema::create('_drivers', function (Blueprint $table)
        {
             $table->id(); 
            $table->string('Driver_Name');
            $table->string('Driver_Phone');
            $table->string('Driver_license_num');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_drivers');
    }
};
