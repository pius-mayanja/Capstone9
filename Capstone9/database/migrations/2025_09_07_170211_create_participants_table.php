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
        Schema::create('participants', function (Blueprint $table) {
            $table->id('ParticipantId'); 
            $table->string('FullName'); 
            $table->string('Email')->unique(); 
            $table->string('Affiliation'); 
            $table->string('Specialization'); 
            $table->text('Description')->nullable(); 
            $table->boolean('CrossSkillTrained')->default(false); 
            $table->string('Institution'); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
