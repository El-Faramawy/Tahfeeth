<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main_reports', function (Blueprint $table) {
            $table->id();
            $table->jsonb('chapters')->nullable();
            $table->jsonb('pages')->nullable();
            $table->smallInteger('surah')->nullable();
            $table->enum('type', ['periodic', 'daily', 'repeated', 'intense'])->default('daily');
            $table->smallInteger('mistakes')->nullable();
            $table->smallInteger('hesitations')->nullable();
            $table->smallInteger('warnings')->nullable();
            $table->float('total_score')->nullable();
            $table->float('max_score')->nullable();
            $table->float('time_taken')->nullable();
            $table->dateTimeTz('reported_at');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('admins');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_reports');
    }
};

