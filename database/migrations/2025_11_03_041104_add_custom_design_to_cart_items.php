<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('custom_design_file')->nullable()->after('product_image');
            $table->boolean('has_custom_design')->default(false)->after('custom_design_file');
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn(['custom_design_file', 'has_custom_design']);
        });
    }
};