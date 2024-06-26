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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('forumId')->index('forumIdx')->constrained('forums')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('userId')->index('userIdx')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('private')->default(0);
            $table->text('content');
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedTinyInteger('closeComments')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
