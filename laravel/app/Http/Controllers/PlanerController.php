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
        $endOfWeek = Carbon::now()->addWeek()->endOfWeek();        $userId = Auth::id();

        $planner = Planner::with('tip_vezbe')
        ->where('user_id', $userId) // column name in quotes
        ->whereBetween('planned_date', [$startOfWeek, $endOfWeek]) // change to start of the week so i can delete bad inputs (it was today before )
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

public function suggestFromLastWeek() {
    $userId = Auth::id();
    $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
    $lastWeekEnd   = Carbon::now()->subWeek()->endOfWeek();
    $nextWeekStart = Carbon::now()->addWeek()->startOfWeek();

    // Uzmi sve vezbe iz prosle nedelje
    $lastWeek = GymProgress::where('user_id', $userId)
        ->whereBetween('Dan', [$lastWeekStart, $lastWeekEnd])
        ->with('tip_vezbe')
        ->get();

    if ($lastWeek->isEmpty()) {
        return back()->with('error', 'Nema podataka iz prošle nedelje.');
    }

    // Grupisi po danu i vezbi, uzmi max tezinu
    $inserted = 0;
    $skipped  = 0;

    $lastWeek->groupBy('tip_vezbe_id')->each(function ($entries) use ($userId, $nextWeekStart, &$inserted, &$skipped) {
        $tipVezbe  = $entries->first()->tip_vezbe;
        $maxTezina = $entries->max('max_tezina');
        $dayOfWeek = Carbon::parse($entries->first()->Dan)->dayOfWeek; // isti dan sledece nedelje
        $plannedDate = $nextWeekStart->copy()->addDays($dayOfWeek - 1);

        // Ne dupliraj ako vec postoji plan za tu vezbu
        $exists = Planner::where('user_id', $userId)
            ->where('tip_vezbe_id', $tipVezbe->id)
            ->where('planned_date', $plannedDate)
            ->exists();

        if ($exists) {
            $skipped++;
            return;
        }

        Planner::create([
            'user_id'      => $userId,
            'tip_vezbe_id' => $tipVezbe->id,
            'goal_weight'  => $maxTezina + $tipVezbe->inkrement,
            'goal_reps'    => $entries->first()->ponavljanja,
            'planned_date' => $plannedDate,
            'status'       => 'pending',
        ]);

        $inserted++;
    });

    return back()->with('success', "Generisano {$inserted} planova, preskočeno {$skipped} duplikata.");
}

    public function getMaxWeight ($id) {
        $userId = Auth::id();
        $exercise = TipVezbe::find($id);

        $max = GymProgress::where('user_id', $userId)
            ->where('tip_vezbe_id', $id)
            ->max('max_tezina');

        return response()->json([
            'max_tezina' => $max ?? 0,
            'inkrement'  => $exercise->inkrement ?? 2.50,
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
