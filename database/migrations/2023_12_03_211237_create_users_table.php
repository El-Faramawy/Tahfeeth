<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("users")) {
            return;
        }
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name', 191)->nullable();
            $table->string('username', 191)->nullable();
            $table->integer('phone_code')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email', 191)->nullable();
            $table->string('password', 191)->nullable();
            $table->integer('code')->nullable();
            $table->dateTime('code_created_at')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality', 191)->nullable();
            $table->string('residation', 191)->nullable();
            $table->string('identification', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('track', ['beginner', 'mid_level', 'high_level'])->nullable();
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->enum('stage', ['dabt', 'taahhud', 'isnad', 'qiraat'])->default('dabt');
            $table->timestamps();
            
            $table->foreign('group_id', 'user_group_id_for')->references('id')->on('groups')->onDelete('set NULL');
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
}
