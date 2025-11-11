<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('article_contents')) {
            DB::statement("ALTER TABLE `article_contents` MODIFY `content_type` ENUM('subheading','paragraph') NOT NULL");
            DB::statement("ALTER TABLE `article_contents` MODIFY `display_order` INT UNSIGNED NOT NULL DEFAULT 0");

            // Ensure composite index exists
            $exists = DB::select("SELECT 1 FROM information_schema.STATISTICS WHERE table_schema = DATABASE() AND table_name = 'article_contents' AND index_name = 'idx_article_order' LIMIT 1");
            if (empty($exists)) {
                DB::statement("CREATE INDEX idx_article_order ON `article_contents`(`article_id`,`display_order`)");
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('article_contents')) {
            DB::statement("ALTER TABLE `article_contents` MODIFY `content_type` VARCHAR(32) NOT NULL");
            DB::statement("ALTER TABLE `article_contents` MODIFY `display_order` INT UNSIGNED NOT NULL DEFAULT 1");
        }
    }
};
