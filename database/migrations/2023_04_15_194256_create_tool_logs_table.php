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
        Schema::create('tool_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->uuid('inventory_id');
            $table->string('purpose');
            $table->date('log_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('end_condition');
            $table->json('additional')->nullable();
            $table->timestamps();

            $table->foreign('inventory_id')->references('inventory_unique')->on('tools')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_logs');
    }
};
