<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class FinanceController extends Controller
{
    //

    public function index ()  {
        $balans = Account::all();
        $transactions = Transaction::all();
        
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
        
        return  View('finance', compact('balans', 'totalsByCurrency', 'totalsByIncome', 'diffs'));
    } 
}
