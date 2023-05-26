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
        Schema::create('report_problems', function (Blueprint $table) {
            $table->id();
            // Pengajuan
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('tool_id')->constrained('tools');
            $table->string('condition');
            $table->text('description');
            $table->string('status')->default('requested');
            $table->foreignId('verificator_id')->nullable()->constrained('users', 'id');
            $table->boolean('accessed')->default(false);

            // Analisa
            $table->foreignId('analyst_id')->nullable()->constrained('users', 'id');
            $table->text('analysis')->nullable();
            $table->dateTime('analyzed_at')->nullable();

            // Tindak lanjut
            $table->string('advance_operator')->nullable();
            $table->string('advance_description')->nullable();
            $table->string('advance_in_charge')->nullable();
            $table->date('advance_target')->nullable();

            // Perbaikan
            $table->string('repair_description')->nullable();
            $table->string('repair_in_charge')->nullable();
            $table->date('repair_target')->nullable();

            // Supervisor
            $table->boolean('effective_status')->nullable();
            $table->string('supervisor_note')->nullable();
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
        Schema::dropIfExists('report_problems');
    }
};
