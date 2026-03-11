<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
        public function index(Request $request) {
        $validated = $request->validate([
            'search'       => 'nullable|string|max:70',
            'muscle_group' => 'nullable|string|max:50',
            'sort'         => 'nullable|in:naziv,personal_record',
            'direction'    => 'nullable|in:asc,desc',
        ]);

        $search       = $validated['search'] ?? null;
        $muscleGroup  = $validated['muscle_group'] ?? null;
        $sort         = $validated['sort'] ?? 'personal_record';
        $direction    = $validated['direction'] ?? 'desc';

        $query = GymProgress::where('user_id', Auth::id())
            ->select('tip_vezbe_id', DB::raw('MAX(max_tezina) as personal_record'))
            ->with('tip_vezbe')
            ->groupBy('tip_vezbe_id');

        if ($search) {
            $query->whereHas('tip_vezbe', function($q) use ($search) {
                $q->where('naziv', 'like', '%' . $search . '%')
                ->orWhere('muscle_group', 'like', '%' . $search . '%');
            });
        }

        if ($muscleGroup) {
            $query->whereHas('tip_vezbe', function($q) use ($muscleGroup) {
                $q->where('muscle_group', $muscleGroup);
            });
        }

        $records = $query->get();

        // Sort u PHP jer je relacija
        $records = $sort === 'naziv'
            ? $records->sortBy(fn($r) => $r->tip_vezbe->naziv, SORT_NATURAL, $direction === 'desc')
            : $records->sortBy('personal_record', SORT_NATURAL, $direction === 'desc');

        // Muscle grupe za dropdown
        $muscleGroups = \App\Models\TipVezbe::distinct()->pluck('muscle_group')->sort()->values();

        return view('records.index', compact('records', 'muscleGroups'));
    }


}