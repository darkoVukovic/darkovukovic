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
        Schema::create('planner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tip_vezbe_id')->constrained('tip_vezbe')->onDelete('cascade');
            $table->date('planned_date');
            $table->decimal('goal_weight', 6, 2);
            $table->integer('goal_reps');
            $table->enum('status', ['pending', 'completed', 'skipped'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
