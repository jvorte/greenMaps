<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('climate_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->date('date');
            $table->decimal('temperature', 5, 2);  // θερμοκρασία
            $table->decimal('humidity', 5, 2)->nullable();  // υγρασία
            $table->decimal('wind_speed', 5, 2)->nullable();  // ταχύτητα ανέμου
            $table->string('plant_type')->nullable();  // είδος βλάστησης
            $table->string('region')->nullable();  // περιοχή
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('climate_data');
    }
};
