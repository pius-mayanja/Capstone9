<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('facilities', function (Blueprint $table) {
        // $table->id('FacilityId');
        $table->id(); // default "id"
        $table->string('Name');
        $table->string('Location');
        $table->text('Description')->nullable();
        $table->string('PartnerOrganization')->nullable();
        $table->string('FacilityType'); // Lab, Workshop, Testing Center
        $table->json('Capabilities')->nullable(); // store multiple capabilities
        $table->timestamps();
    });
}
};
