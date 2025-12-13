<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaction()
    {
        $user = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $user->id]);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'account_id' => $account->id,
            'type' => 'income',
            'category' => 'Plata',
            'amount' => 50000,
            'currency' => 'RSD',
            'description' => 'Mesečna plata',
            'date' => now()
        ]);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'account_id' => $account->id,
            'type' => 'income',
            'amount' => 50000
        ]);
    }

    public function test_transaction_belongs_to_account()
    {
        $user = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $user->id]);
        
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'account_id' => $account->id,
            'type' => 'income',
            'category' => 'Plata',
            'amount' => 5000,
            'currency' => 'RSD',
            'description' => 'Test transaction',
            'date' => now()
        ]);

        $this->assertEquals($account->id, $transaction->account->id);
    }
}