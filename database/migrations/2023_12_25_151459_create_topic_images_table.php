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
        Schema::create('topic_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index('topicIdx')->constrained('topics', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('userId')->index('userIdx')->constrained('users', 'id');
            $table->string('imagePath');
            $table->string('imageUrl');
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
        Schema::dropIfExists('topic_images');
    }
};
