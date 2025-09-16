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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('facility_id');
            $table->string('title');
            $table->enum('nature_of_project', ['research', 'prototype', 'applied']);
            $table->text('description')->nullable();
            $table->string('innovation_focus')->nullable();
            $table->enum('prototype_stage', ['concept', 'prototype', 'mvp', 'market_launch'])->default('concept');
            $table->text('testing_requirements')->nullable();
            $table->text('commercialization_plan')->nullable();
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
