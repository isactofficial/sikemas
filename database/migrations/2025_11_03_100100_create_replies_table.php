<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('content');
            $table->unsignedInteger('likes_count')->default(0);
            $table->timestamps();

            $table->index(['comment_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
