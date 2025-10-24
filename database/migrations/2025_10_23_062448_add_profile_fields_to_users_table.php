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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom setelah 'email'
            $table->string('phone', 20)->nullable()->after('email');
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('gender');
            $table->string('profile_photo')->nullable()->after('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'gender', 'birth_date', 'profile_photo']);
        });
    }
};