<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
  public function create()  {
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
                'type' => 'required|in:income,expense',
                'category' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'currency' => 'required|in:RSD,EUR',
                'description' => 'nullable|string',
                'date' => 'required|date',
            ]);

            DB::transaction(function () use ($validated) {
                Transaction::create([
                    'user_id' => Auth::id(),
                    ...$validated
                ]);

                $account = Account::findOrFail($validated['account_id']);
                
                if ($validated['type'] === 'income') {
                    $account->increment('balance', $validated['amount']);
                } else {
                    $account->decrement('balance', $validated['amount']);
                }
            });

            return redirect()->route('finance')->with('success', 'Transakcija dodata!');
        }


        public function destroy(Transaction $transaction)
        {
            // Security check - da li transakcija pripada trenutnom korisniku
            if ($transaction->user_id !== Auth::id()) {
                abort(403, 'Unauthorized');
            }

            DB::transaction(function () use ($transaction) {
                // Vrati balance nazad pre brisanja
                $account = Account::findOrFail($transaction->account_id);
                
                if ($transaction->type === 'income') {
                    $account->decrement('balance', $transaction->amount); // Skini nazad
                } elseif ($transaction->type === 'expense') {
                    $account->increment('balance', $transaction->amount); // Dodaj nazad
                }
                
                // Obriši transakciju
                $transaction->delete();
            });

            return redirect()->route('finance')
                ->with('success', 'Transakcija obrisana!');
        }
}
