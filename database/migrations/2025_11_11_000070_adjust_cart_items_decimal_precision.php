<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('cart_items')) {
            DB::statement("ALTER TABLE `cart_items` MODIFY `unit_price` DECIMAL(10,2) NOT NULL");
            DB::statement("ALTER TABLE `cart_items` MODIFY `subtotal` DECIMAL(10,2) NOT NULL");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('cart_items')) {
            DB::statement("ALTER TABLE `cart_items` MODIFY `unit_price` DECIMAL(15,2) NOT NULL");
            DB::statement("ALTER TABLE `cart_items` MODIFY `subtotal` DECIMAL(15,2) NOT NULL");
        }
    }
};