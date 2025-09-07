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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('FacilityId')->constrained('facilities','FacilityId')->cascadeOnDelete();
            $table->string('Name');
            $table->text('Description')->nullable();
            $table->string('Category');   // Machining, Testing, Training
            $table->string('SkillType');  // Hardware, Software, Integration
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};







