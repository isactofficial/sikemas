<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('articles')) {
            // Convert status to enum draft/published
            DB::statement("ALTER TABLE `articles` MODIFY `status` ENUM('draft','published') NOT NULL DEFAULT 'draft'");
            // Add missing indexes if not exist (MySQL 8.0+ supports IF NOT EXISTS)
            DB::statement("CREATE INDEX IF NOT EXISTS idx_status ON `articles`(`status`)");
            DB::statement("CREATE INDEX IF NOT EXISTS idx_slug ON `articles`(`slug`)");
            DB::statement("CREATE INDEX IF NOT EXISTS idx_created_at ON `articles`(`created_at`)");
        }
    }

    public function down(): void
    {
        // Revert status back to string (len 20) if needed
        if (Schema::hasTable('articles')) {
            DB::statement("ALTER TABLE `articles` MODIFY `status` VARCHAR(20) NOT NULL DEFAULT 'draft'");
            // indexes left intact intentionally
        }
    }
};
