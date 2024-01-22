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
        if (Schema::hasTable("teachers")) {
            return;
        }
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('username', 191)->nullable();
            $table->integer('phone_code')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email', 191)->nullable();
            $table->string('password', 191)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality', 191)->nullable();
            $table->string('residation', 191)->nullable();
            $table->string('identification', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->tinyInteger('can_accept_beginner_user')->default(0);
            $table->tinyInteger('can_accept_user')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
