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
        Schema::table('gym_progress', function (Blueprint $table) {
            $table->dropColumn('tip_vezbe'); // remove the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('gym_progress', function (Blueprint $table) {
            $table->string('tip_vezbe')->nullable(); // add it back if needed
        });
    }
};
