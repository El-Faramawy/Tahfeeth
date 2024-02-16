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
        if (Schema::hasTable("change_save_amounts")) {
            return;
        }
        Schema::create('change_save_amounts', function (Blueprint $table) {
            $table->id();
            $table->string('amount')->nullable();
            $table->string('reason',500)->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('change_save_amounts');
    }
};
