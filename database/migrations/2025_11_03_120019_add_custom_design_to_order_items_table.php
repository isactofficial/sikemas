<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nama class akan mengikuti nama file Anda, 
// atau bisa juga anonim seperti ini jika Anda membuatnya tanpa nama
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Tambahkan kolom persis seperti di cart_items
            // Kolom ini akan menyimpan path ke file gambar
            $table->string('custom_design_file')->nullable()->after('product_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Ini akan menghapus kolom jika Anda perlu rollback
            $table->dropColumn('custom_design_file');
        });
    }
};