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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // $table->foreignId('inventory_number')->constrained('tools', 'inventory_number');
            $table->uuid('inventory_id');
            $table->string('purpose');
            $table->date('start_borrow_date');
            $table->date('expected_return_date')->nullable();
            $table->date('actual_return_date')->nullable();
            $table->string('status')->default('pending');
            $table->string('description')->nullable();
            $table->foreignId('verificator_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->string('verified_note')->nullable();
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
        Schema::dropIfExists('borrows');
    }
};
