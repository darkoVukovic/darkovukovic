<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
  public function create()
{
    $accounts = Account::where('user_id', Auth::id())->get();
    
    // Ako nemaš nijedan račun, redirectuj da napravi prvo račun
    if ($accounts->isEmpty()) {
        return redirect()->route('accounts.create')
            ->with('warning', 'Prvo napravi račun pre dodavanja transakcije.');
    }
    
    return view('transactions.create', compact('accounts'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'account_id' => 'required|exists:accounts,id',
        'type' => 'required|in:income,expense,transfer',
        'category' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0.01',
        'currency' => 'required|in:RSD,EUR',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    Transaction::create([
        'user_id' => Auth::id(),
        ...$validated
    ]);

    return redirect()->route('finance')
        ->with('success', 'Transakcija uspešno dodata!');
}
}
