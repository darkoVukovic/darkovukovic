<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_account()
    {
        $user = User::factory()->create();

        $account = Account::create([
            'user_id' => $user->id,
            'name' => 'Tekući račun',
            'currency' => 'RSD',
            'balance' => 10000,
            'type' => 'bank'
        ]);

        $this->assertDatabaseHas('accounts', [
            'user_id' => $user->id,
            'name' => 'Tekući račun',
            'balance' => 10000
        ]);
    }

    public function test_account_belongs_to_user()
    {
        $user = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $account->user->id);
    }
}