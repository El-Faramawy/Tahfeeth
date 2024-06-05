<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (false === Schema::hasColumn('main_reports', 'memorization_part')) {
            Schema::table('main_reports', function (Blueprint $table) {
                $table->string('memorization_part')->nullable();
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_reports', function (Blueprint $table) {
            //
        });
    }
};
