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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index()->constrained('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('mainPost')->default(0);
            $table->foreignId('userId')->index()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('replyId')->default(0);
            $table->text('message');

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
        Schema::dropIfExists('posts');
    }
};
