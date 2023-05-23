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
            $table->foreignId('reportTypeId')->index()->constrained('report_types');
            $table->foreignId('postId')->index()->constrained('posts');
            $table->foreignId('userId')->index()->constrained('users');
            $table->foreignId('senderId')->index()->constrained('users');
            $table->tinyInteger('processed')->default(0);
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
