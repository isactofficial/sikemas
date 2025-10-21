<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_produk')->nullable();
            $table->string('wujud_produk')->nullable();
            $table->json('kondisi_produk')->nullable();
            $table->string('material_produk')->nullable();
            $table->string('jarak_distribusi')->nullable();
            $table->json('cara_pengiriman')->nullable();
            $table->text('catatan')->nullable();
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveys');
    }
};