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
            $table->foreignId('tip_vezbe_id')->nullable()->constrained('tip_vezbe')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gym_progress', function (Blueprint $table) {
            //
        });
    }
};
