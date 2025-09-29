<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id('thread_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('titel', 200);
            $table->text('beschrijving');
            $table->timestamps(); // created_at en updated_at

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
