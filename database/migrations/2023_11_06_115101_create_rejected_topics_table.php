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
        Schema::create('rejected_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topicId')->index('topicIdx')->constrained('topics', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('reasonId')->index('reasonIdx')->constrained('topic_rejected_types', 'id');
            $table->tinyText('message')->nullable();
            $table->foreignId('userId')->index('userIdx')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            //$table->foreignId('moderId')->index('userIdx')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('rejected_topics');
    }
};
