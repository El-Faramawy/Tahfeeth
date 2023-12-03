<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("settings")) {
            return;
        }
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp', 191)->nullable();
            $table->integer('group_limit')->default(0);
            $table->integer('group_number')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('logo', 191)->nullable();
            $table->string('fav_icon', 191)->nullable();
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
        Schema::dropIfExists('settings');
    }
}
