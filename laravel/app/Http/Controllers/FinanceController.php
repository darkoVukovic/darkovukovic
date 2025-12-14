<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        
        // ✅ Koristi relationships
        $balans = $user->accounts;
        $transactions = $user->transactions;
        
        $totalsByCurrency = $balans->groupBy('currency')->map(function ($items) {
            return $items->sum('balance');
        });

        $totalsByIncome = $transactions->groupBy(['type', 'currency'])
            ->map(function ($byType) {
                return $byType->map(function ($items) {
                    return $items->sum('amount');
                });
            });
    
        $diffs = [];
        foreach ($totalsByIncome['income'] ?? [] as $currency => $income) {
            $expense = $totalsByIncome['expense'][$currency] ?? 0;
            $diffs[$currency] = $income - $expense;
        }
        
        $transactionsPaginate = $user->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('finance', compact('balans', 'totalsByCurrency', 'totalsByIncome', 'diffs', 'transactionsPaginate'));
    }
}
