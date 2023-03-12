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
        Schema::create('externs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->string('extern_name');
            $table->string('extern_address');
            $table->string('extern_phone');
            $table->foreignId('profession_id')->constrained('professions');
            $table->string('identification_type');
            $table->string('identification_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('externs');
    }
};
