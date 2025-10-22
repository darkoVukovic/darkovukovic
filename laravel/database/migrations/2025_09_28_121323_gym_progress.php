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
          Schema::create('gym_progress', function (Blueprint $table) {
            $table->id();
            $table->string('Dan');
            $table->integer('max_tezina');
            $table->integer('ponavljanja');
            $table->string('tip_vezbe');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           Schema::dropIfExists('gym_progress');
    }
};
