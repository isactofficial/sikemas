<?php

// ========================================
// File 1: XXXX_XX_XX_create_user_addresses_table.php
// Jalankan: php artisan make:migration create_user_addresses_table
// ========================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('address_type', ['Home', 'Office']);
            $table->string('address_line');
            $table->string('city', 100);
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('country', 100)->default('Indonesia');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            
            // Foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Index
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};

// ========================================
// File 2: XXXX_XX_XX_create_orders_table.php
// Jalankan: php artisan make:migration create_orders_table
// ========================================

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_number', 50)->unique();
            $table->date('order_date');
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['Selesai', 'Diproses', 'Dibatalkan'])->default('Diproses');
            $table->string('payment_method', 50)->nullable();
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('shipping_address_id')
                  ->references('id')
                  ->on('user_addresses')
                  ->onDelete('set null');
            
            // Indexes
            $table->index('user_id');
            $table->index('invoice_number');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

// ========================================
// File 3: XXXX_XX_XX_create_order_items_table.php
// Jalankan: php artisan make:migration create_order_items_table
// ========================================

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamp('created_at')->useCurrent();
            
            // Foreign key
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
            
            // Index
            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};