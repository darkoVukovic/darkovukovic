<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Planner;
use App\Models\TipVezbe;
use App\Models\GymProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanerController extends Controller
{
    
    public function index () {
        $exercises = TipVezbe::all();
        $today = Carbon::today();
        

       $startOfWeek = $today->copy()->startOfWeek();
       $endOfWeek = $today->copy()->endOfWeek();
        $userId = Auth::id();

        $planner = Planner::with('tip_vezbe')
        ->where('user_id', $userId) // column name in quotes
        ->whereBetween('planned_date', [$today, $endOfWeek])
        ->where('status', 'pending') 
        ->orderBy('planned_date')
        ->get();

    

        return view('planner', compact('exercises', 'planner', 'today', 'endOfWeek'));
        

    } 

    public function destroy(Planner $plan){
    // Optional: check if the logged-in user owns this plan
    if ($plan->user_id !== Auth::id()) {
        abort(403);
    }

    $plan->delete();

    return redirect()->back()->with('success', 'Plan obrisan.');
}

    public function getMaxWeight ($id) {
        $userId = Auth::id();

        $max = GymProgress::where('user_id', $userId)
        ->where('tip_vezbe_id', $id)
        ->max('max_tezina');

          return response()->json([
            'max_tezina' => $max ?? 0, // 0 if no record yet
        ]);
    } 


    public function store (Request $request) {
        $exercise = TipVezbe::find($request->tip_vezbe_id);


       // $heaviest = GymProgress::where('tip_vezbe_id', $exercise->id)
       // ->orderByDesc('max_tezina')
       // ->first();

       // $lastWeight = $heaviest->max_tezina ?? 0;
       // $increment = 2.5;
        //$goalWeight = $lastWeight ? $lastWeight + $increment : $increment; // i put my own weight i want i just display heaviest i did so far 


        Planner::create([
            'tip_vezbe_id' => $exercise->id,
            'planned_date' => $request->planned_date,
            'goal_weight' => $request->goal_weight,
            'goal_reps' => $request->goal_reps ?? 10,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'vezbba dodata u planer');

        
    } 
}
