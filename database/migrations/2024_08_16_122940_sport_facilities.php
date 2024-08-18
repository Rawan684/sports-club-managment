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
        Schema::create('sport_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sport_id');
            $table->unsignedInteger('facility_id');
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('facility_id')->references('id')->on('facilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_facilities');
    }
};
