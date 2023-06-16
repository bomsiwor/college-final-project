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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('identifier');
            $table->string('identification_number')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('description')->nullable();

            // institution
            $table->foreignId('institution_id')->constrained('institutions')->cascadeOnDelete();

            // Job
            $table->foreignId('profession_id')->constrained()->cascadeOnDelete();

            // For Student
            $table->foreignId('study_program_id')->nullable()->constrained()->cascadeOnDelete();

            // For Staff Position
            $table->foreignId('unit_id')->nullable()->constrained('units')->cascadeOnDelete();

            // Github
            $table->string('github_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
