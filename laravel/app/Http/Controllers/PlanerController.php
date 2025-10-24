<?php

namespace App\Http\Controllers;

use App\Models\GymProgress;
use App\Models\Planner;
use App\Models\TipVezbe;
use Illuminate\Http\Request;

class PlanerController extends Controller
{
    
    public function index () {
        $exercises = TipVezbe::all();

        $planner = Planner::with('tip_vezbe')
            ->whereDate('planned_date', '>=', now()->toDateString())
            ->get(); 
        return view('planner', compact('exercises', 'planner'));
        

    } 

    public function store (Request $request) {
        $exercise = TipVezbe::find($request->tip_vezbe_id);


        $heaviest = GymProgress::where('tip_vezbe_id', $exercise->id)
        ->orderByDesc('max_tezina')
        ->first();

        $lastWeight = $heaviest->max_tezina ?? 0;
        $increment = 2.5;
        $goalWeight = $lastWeight ? $lastWeight + $increment : $increment;

        Planner::create([
            'tip_vezbe_id' => $exercise->id,
            'planned_date' => $request->planned_date,
            'goal_weight' => $goalWeight,
            'goal_reps' => $request->goal_reps ?? 10,
            'status' => 'pending'
        ]);

        return back()->with('success', 'vezbba dodata u planer');

        
    } 
}
