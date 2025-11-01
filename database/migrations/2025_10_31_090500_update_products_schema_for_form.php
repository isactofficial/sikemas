<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('image')->nullable();
                $table->string('category')->nullable();
                $table->decimal('price', 15, 2)->nullable();
                $table->text('description')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
            return; // created fresh table
        }

        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->nullable()->unique();
            }
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->nullable();
            }
            if (!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('products', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('products')) {
            return; // nothing to do
        }

        // If the table only had these columns added by this migration, just drop them safely
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
