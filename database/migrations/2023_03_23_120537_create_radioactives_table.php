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
            $table->uuid('inventory_unique')->unique();
            $table->integer('entry_number')->nullable();
            $table->string('inventory_number');
            $table->string('element_name')->nullable()->default('unknown');
            $table->string('element_symbol')->nullable()->default('unknown');
            $table->string('isotope_number')->nullable();
            $table->string('slug')->nullable();
            $table->integer('initial_activity');
            $table->integer('quantity');
            $table->string('packaging_type');
            $table->date('purchase_date')->nullable();
            $table->date('manufacturing_date');
            $table->string('status');
            $table->string('condition');
            $table->string('properties');
            $table->text('description')->nullable();
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
