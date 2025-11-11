<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'shipping_cost')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('shipping_cost');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'shipping_cost')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('shipping_cost', 15, 2)->default(20000)->after('total_amount');
            });
        }
    }
};
