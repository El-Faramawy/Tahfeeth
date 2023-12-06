<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("contacts")) {
            return;
        }
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('subject', 191)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('message')->nullable();
            $table->enum('type', ['complaint', 'suggestion', 'question'])->default('complaint');
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
        Schema::dropIfExists('contacts');
    }
}
