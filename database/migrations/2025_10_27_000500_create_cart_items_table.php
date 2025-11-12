<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
            $table->string('product_name');
            $table->string('material')->nullable();
            $table->string('size')->nullable();
            $table->string('design')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2); // match dump precision
            $table->decimal('subtotal', 10, 2);   // match dump precision
            $table->string('product_image')->nullable();
            // custom_design_file & has_custom_design added in later migration
            $table->timestamps();

            $table->index(['cart_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};