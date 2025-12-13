<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // "Tekući račun", "Keš", "Štednja"
            $table->string('currency', 3)->default('RSD'); // RSD, EUR, USD
            $table->decimal('balance', 15, 2)->default(0); // 15 cifara, 2 decimale
            $table->string('type')->default('cash'); // cash, bank, savings
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('type'); // income, expense, transfer
            $table->string('category'); // "Hrana", "Transport", "Plata", etc.
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('RSD');
            $table->text('description')->nullable();
            $table->date('date'); // Datum transakcije
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('accounts');
    }
};
