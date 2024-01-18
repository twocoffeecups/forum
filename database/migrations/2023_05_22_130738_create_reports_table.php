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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reasonId')->index('reportReasonIdx')->constrained('report_reason_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('object', ['topic', 'post']);
            $table->foreignId('postId')->nullable()->index('postIdx')->constrained('posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('topicId')->nullable()->index('topicIdx')->constrained('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('userId')->index('userIdx')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('senderId')->index('senderIdx')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('moderId')->index('moderIdx')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('closed')->default(0);
            $table->string('message')->nullable();
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
        Schema::dropIfExists('reports');
    }
};
