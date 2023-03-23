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
        Schema::create('radioactives', function (Blueprint $table) {
            $table->id();
            $table->uuid('inventory_number')->unique();
            $table->string('name');
            $table->string('isotope_number');
            $table->string('slug');
            $table->date('purchase_date');
            $table->date('production_date');
            $table->integer('activity_ci');
            $table->integer('activity_bq');
            $table->string('product_number');
            $table->text('description');
            $table->string('status');
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
        Schema::dropIfExists('radioactives');
    }
};
