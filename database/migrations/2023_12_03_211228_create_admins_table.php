<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("admins")) {
            return;
        }
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique('admins_email_unique');
            $table->text('image')->nullable();
            $table->string('phone', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_reset')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
