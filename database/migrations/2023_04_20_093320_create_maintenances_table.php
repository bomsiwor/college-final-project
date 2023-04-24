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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->string('agenda')->nullable()->default('Tentative');
            $table->date('month');
            $table->date('actual_date')->nullable();
            $table->boolean('is_done')->default(false);
            $table->string('document')->nullable();
            $table->string('in_charge');
            $table->text('description')->nullable();
            $table->text('operation_note')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
};
