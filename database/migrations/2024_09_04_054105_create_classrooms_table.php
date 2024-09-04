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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('name'); // Name of the classroom (e.g., Class 1, Class 2)
            $table->string('section')->nullable(); // Section of the classroom (optional)
            $table->string('teacher')->nullable(); // Name of the classroom teacher (optional)
            $table->text('description')->nullable(); // Description of the classroom (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
