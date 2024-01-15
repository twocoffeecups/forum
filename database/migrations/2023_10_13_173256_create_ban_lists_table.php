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
        Schema::create('ban_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->index()->constrained('users');
            $table->string('email');
            $table->foreignId('reportId')->index('reportIdx')->constrained('reports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('reasonId')->index('reasonIdx')->constrained('report_reason_types')->cascadeOnDelete();
            $table->unsignedTinyInteger('banExclude')->default(0);
            $table->timestamp('banStart')->useCurrent();;
            $table->timestamp('banEnd');
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
        Schema::dropIfExists('ban_lists');
    }
};
