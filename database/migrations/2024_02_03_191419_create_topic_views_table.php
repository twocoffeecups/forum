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
        Schema::create('topic_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index('topicIdx')->constrained('topics');
            $table->string("url");
            $table->string("sessionId");
            $table->foreignId("userId")->nullable()->index('userIdx')->constrained('users');
            $table->ipAddress("ip");
            $table->string("agent");
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_views');
    }
};
