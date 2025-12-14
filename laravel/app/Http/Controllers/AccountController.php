<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:cash,bank,savings',
            'currency' => 'required|in:RSD,EUR,USD',
            'balance' => 'required|numeric|min:0',
        ]);

        Account::create([
            'user_id' => Auth::id(),
            ...$validated
        ]);

        return redirect()->route('finance')
            ->with('success', 'Račun uspešno dodat!');
    }

    public function edit(Account $account)
    {
        // Proveri da li account pripada trenutnom korisniku
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }

        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:cash,bank,savings',
            'currency' => 'required|in:RSD,EUR,USD',
            'balance' => 'required|numeric|min:0',
        ]);

        $account->update($validated);

        return redirect()->route('finance')
            ->with('success', 'Račun uspešno ažuriran!');
    }

        public function destroy(Account $account)
        {
            // Security check
            if ($account->user_id !== Auth::id()) {
                abort(403, 'Unauthorized');
            }

            // Proveri da li račun ima transakcije
            if ($account->transactions()->count() > 0) {
                return redirect()->route('finance')
                    ->with('error', 'Ne možete obrisati račun koji ima transakcije!');
            }

            $account->delete();

            return redirect()->route('finance')
                ->with('success', 'Račun uspešno obrisan!');
        }
}