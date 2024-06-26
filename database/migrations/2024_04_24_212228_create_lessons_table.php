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
        if (Schema::hasTable("lessons")) {
            return;
        }
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('number')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('voice')->nullable();
            $table->string('video')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
