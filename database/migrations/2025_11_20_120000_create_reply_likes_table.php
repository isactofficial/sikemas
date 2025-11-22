<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reply_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reply_id')->constrained('replies')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['reply_id', 'user_id']);
            $table->index(['user_id', 'reply_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reply_likes');
    }
};
