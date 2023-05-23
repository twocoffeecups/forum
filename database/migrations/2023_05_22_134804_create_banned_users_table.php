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
        Schema::create('banned_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->index()->constrained('users');
            $table->foreignId('banTypeId')->index()->constrained('ban_types');
            $table->boolean('status')->default(0);
            $table->timestamp('startDate');
            $table->time('expDate');
            //$table->timestamps();

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
        Schema::dropIfExists('banned_users');
    }
};
