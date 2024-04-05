<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('private_topic_accessed_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index('topicIdx')->constrained('topics');
            $table->foreignId('userId')->index('userIdx')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_topic_accessed_users');
    }
};
