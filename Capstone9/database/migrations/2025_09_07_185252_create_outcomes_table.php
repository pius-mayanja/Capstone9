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
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('artifact_link')->nullable();
            $table->enum('outcome_type', ['cad', 'pcb', 'prototype', 'report', 'business_plan']);
            $table->string('quality_certification')->nullable();
            $table->enum('commercialization_status', ['demoed', 'market_linked', 'launched'])->default('demoed');
            $table->timestamps();
    
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
