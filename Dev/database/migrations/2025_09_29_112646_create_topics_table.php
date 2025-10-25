<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id('topic_id');
            $table->foreignId('thread_id')->constrained('threads', 'thread_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('title', 200);
            $table->text('body');
            $table->timestamps(); // created_at en updated_at

            $table->index('thread_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
