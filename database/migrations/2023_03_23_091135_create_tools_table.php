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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->uuid('inventory_number')->unique();
            $table->string('name');
            $table->string('merk');
            $table->string('series')->nullable();
            $table->text('description')->nullable();
            $table->string('tool_image')->nullable();
            $table->string('condition');
            $table->string('status');
            $table->date('purchase_date')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('tools');
    }
};
