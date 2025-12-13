<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => 'Test račun',
            'currency' => 'RSD',
            'balance' => 1000,
            'type' => 'cash',
        ];
    }
}