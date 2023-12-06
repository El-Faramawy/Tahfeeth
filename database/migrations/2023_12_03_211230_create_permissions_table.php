<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("permissions")) {
            return;
        }
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('name', 191)->nullable();
            $table->timestamps();
            
            $table->foreign('section_id', 'per_sec_id')->references('id')->on('permission_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
