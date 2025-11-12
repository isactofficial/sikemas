<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->string('content_type', 32); // 'subheading' | 'paragraph'
            $table->longText('content')->nullable();
            $table->unsignedInteger('display_order')->default(1);
            $table->timestamps();

            $table->index(['article_id', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_contents');
    }
};