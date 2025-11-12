<?php
// File: database/migrations/YYYY_MM_DD_HHMMSS_create_consultations_table.php

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
        Schema::create('free_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'scheduled', 'completed', 'cancelled'])->default('pending');
            $table->dateTime('consultation_date')->nullable();
            $table->text('notes')->nullable(); // Untuk catatan admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_consultations');
    }
};