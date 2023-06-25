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
        Schema::create('radioactive_returnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_id')->constrained('radioactive_borrows')->cascadeOnDelete();
            $table->foreignId('verificator_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('returning_date');
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
        Schema::dropIfExists('radioactive_returnings');
    }
};
