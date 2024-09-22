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
        Schema::create('attendances', function (Blueprint $table) {
              $table->id();
              $table->foreignId('student_id')->constrained()->onDelete('cascade');
              $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
              $table->date('date');  // Store the attendance date
              $table->boolean('status')->default(1);  // 1 for present, 0 for absent (optional)
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
