<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_topic_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index('topicIdx')->constrained('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('userId')->index('userIdx')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_topic_bookmarks');
    }
};
