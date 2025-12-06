<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // gym_progress - only add composite index (Dan and user_id already exist)
        Schema::table('gym_progress', function (Blueprint $table) {
            $table->index(['user_id', 'Dan'], 'gym_progress_user_id_dan_index');
        });

        // planner - add missing indexes
        Schema::table('planner', function (Blueprint $table) {
            $table->index('planned_date');
            $table->index('status');
            $table->index(['user_id', 'planned_date'], 'planner_user_id_planned_date_index');
            $table->index(['user_id', 'status'], 'planner_user_id_status_index');
        });

        // tip_vezbe - add indexes
        Schema::table('tip_vezbe', function (Blueprint $table) {
            $table->index('naziv');
            $table->index('muscle_group');
        });
    }

    public function down(): void
    {
        Schema::table('gym_progress', function (Blueprint $table) {
            $table->dropIndex('gym_progress_user_id_dan_index');
        });

        Schema::table('planner', function (Blueprint $table) {
            $table->dropIndex(['planned_date']);
            $table->dropIndex(['status']);
            $table->dropIndex('planner_user_id_planned_date_index');
            $table->dropIndex('planner_user_id_status_index');
        });

        Schema::table('tip_vezbe', function (Blueprint $table) {
            $table->dropIndex(['naziv']);
            $table->dropIndex(['muscle_group']);
        });
    }
};