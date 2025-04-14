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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('summit');
            $table->string('plot');
            $table->string('plant_type');
            $table->string('survey_type');
            $table->string('species');
            $table->string('cover');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Σύνδεση με τον χρήστη
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
