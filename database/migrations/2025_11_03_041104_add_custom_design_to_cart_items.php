<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                if (!Schema::hasColumn('cart_items', 'custom_design_file')) {
                    $table->string('custom_design_file')->nullable()->after('product_image');
                }
                if (!Schema::hasColumn('cart_items', 'has_custom_design')) {
                    $table->boolean('has_custom_design')->default(false)->after('custom_design_file');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $cols = [];
                if (Schema::hasColumn('cart_items', 'custom_design_file')) {
                    $cols[] = 'custom_design_file';
                }
                if (Schema::hasColumn('cart_items', 'has_custom_design')) {
                    $cols[] = 'has_custom_design';
                }
                if (!empty($cols)) {
                    $table->dropColumn($cols);
                }
            });
        }
    }
};