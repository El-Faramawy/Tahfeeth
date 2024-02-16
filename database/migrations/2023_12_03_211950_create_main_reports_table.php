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
        if (Schema::hasTable("main_reports")) {
            return;
        }
        Schema::create('main_reports', function (Blueprint $table) {
            $table->id();
            $table->jsonb('chapters')->nullable();
            $table->jsonb('pages')->nullable();
            // daily
            $table->jsonb('new')->nullable();
            $table->jsonb('previous')->nullable();
            $table->jsonb('old')->nullable();
            $table->smallInteger('current_from')->nullable();
            $table->smallInteger('current_to')->nullable();
            $table->smallInteger('lesson')->nullable();
            $table->tinyInteger('listen')->nullable()->default(0);
            $table->tinyInteger('repeat')->nullable()->default(0);
            // daily
            $table->smallInteger('amount_of_pages')->nullable();
            // repeated
            $table->smallInteger('repeated_amount')->nullable();
            // periodic
            $table->tinyInteger('stage')->default(0);
            $table->smallInteger('level')->nullable();

            $table->smallInteger('surah')->nullable();
            $table->enum('type', ['periodic', 'daily', 'repeated', 'intense'])->default('daily');
            $table->smallInteger('mistakes')->nullable();
            $table->smallInteger('hesitations')->nullable();
            $table->smallInteger('warnings')->nullable();
            $table->float('total_score')->nullable();
            $table->float('max_score')->nullable();
            $table->float('time_taken')->nullable();
            $table->dateTimeTz('reported_at');
            $table->string('day')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers');
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

