<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        
         $validated = $request->validate([
            'search' => 'nullable|string|max:70'
        ]);
        $search = $validated['search'] ?? null;
        
        $query = GymProgress::where('user_id', Auth::id())
            ->select('tip_vezbe_id', DB::raw('MAX(max_tezina) as personal_record'))
            ->with('tip_vezbe')
            ->groupBy('tip_vezbe_id');
        
        // Ako ima search term
        if ($search) {
            $query->whereHas('tip_vezbe', function($q) use ($search) {
                $q->where('naziv', 'like', '%' . $search . '%')
                ->orWhere('muscle_group', 'like', '%' . $search . '%');
            });
        }
        
        $records = $query->get();
        
        return view('records.index', compact('records'));
    }
}