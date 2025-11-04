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
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan dua kolom baru setelah kolom 'status'
            $table->string('payment_status')->default('Unpaid')->after('status');
            $table->string('shipping_status')->default('Pending')->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn(['payment_status', 'shipping_status']);
        });
    }
};
