<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gym_progress', function (Blueprint $table) {
            $table->decimal('max_tezina', 5, 2)->change(); // 8 cifara, 2 decimale
        });
    }

    public function down(): void
    {
        Schema::table('gym_progress', function (Blueprint $table) {
            $table->integer('max_tezina')->change();
        });
    }
};