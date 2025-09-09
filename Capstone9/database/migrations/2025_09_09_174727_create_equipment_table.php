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
    Schema::create('equipment', function (Blueprint $table) {
        $table->id('EquipmentId');
        $table->string('Name');
        $table->string('Type');              // Tool, Machine, Device
        $table->string('Capability');        // e.g. "3D Printing"
        $table->string('Domain')->nullable(); // e.g. "Mechanical"
        $table->text('Description')->nullable();
        $table->foreignId('FacilityId')->nullable()->constrained('facilities')->cascadeOnDelete();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
