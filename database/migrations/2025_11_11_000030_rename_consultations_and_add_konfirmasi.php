<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename consultations -> free_consultations if needed
        if (Schema::hasTable('consultations') && !Schema::hasTable('free_consultations')) {
            Schema::rename('consultations', 'free_consultations');
        }

        // Add konfirmasi enum if missing
        if (Schema::hasTable('free_consultations') && !Schema::hasColumn('free_consultations', 'konfirmasi')) {
            Schema::table('free_consultations', function (Blueprint $table) {
                $table->enum('konfirmasi', ['waiting','on-going','confirmed'])->default('waiting')->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('free_consultations') && Schema::hasColumn('free_consultations', 'konfirmasi')) {
            Schema::table('free_consultations', function (Blueprint $table) {
                $table->dropColumn('konfirmasi');
            });
        }

        if (Schema::hasTable('free_consultations') && !Schema::hasTable('consultations')) {
            Schema::rename('free_consultations', 'consultations');
        }
    }
};
