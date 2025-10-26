<?php

namespace App\Http\Controllers;

use App\Models\Planner;
use App\Models\TipVezbe;
use App\Models\GymProgress;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Workouts extends Controller
{
    


    public function  index () {

            return View('workouts');

    }
    
    public function create (): View {

        $muscleGroups = TipVezbe::all();
        $exercises = TipVezbe::all();
        
        //$existingExercise = GymProgress::where('user_id', Auth::id())->distinct()->pluck('tip_vezbe');
        $existingExercise = GymProgress::where('user_id', Auth::id())
            ->with('tip_vezbe')
            ->get()
            ->pluck('tip_vezbe.naziv')
            ->unique();


        return View('create',compact('existingExercise', 'muscleGroups'));
    } 

    public function store (Request $request) {
    


    $request->validate([
        'Dan' => 'required|max:15',
        'max_tezina' => 'required|numeric',
        'ponavljanja' => 'required|numeric',
        'tip_vezbe' => 'required|max:25',
        'muscle_group' => 'required|max:50', 
    ]);

    $tip_vezbe = TipVezbe::firstOrCreate([
        'naziv' => $request->tip_vezbe,
        'muscle_group' => $request->muscle_group
     ]);



    //Auth::user()->gymProgress()->create($request->all());
    Auth::user()->gymProgress()->create([
        'Dan' => $request->Dan,
        'tip_vezbe_id' => $tip_vezbe->id,
        'max_tezina' => $request->max_tezina,
        'ponavljanja' => $request->ponavljanja,
    ]);

     $plan = Planner::where('tip_vezbe_id', $tip_vezbe->id)
        ->where('user_id', Auth::id())
        ->where('planned_date', now()->toDateString())
        ->where('status', 'pending')
        ->first();

    if ($plan) {
        $plan->update(['status' => 'completed']);
    }

    return redirect()->back()->with('success', 'Item created!');
    
    } 

    /*
    public function storeFromPLanner (Request $request, Planner $planner) {
        GymProgress::create([
            'tip_vezbe_id' => $planner->tip_vezbe_id,
            'Dan' => $planner->planned_date,     // or planner->planned_date if you prefer
            'max_tezina' => $request->weight,         // actual lifted weight
            'ponavljanja' => $request->reps,          // actual reps
            'user_id' => Auth::id(),   
        ]);

        $planner->update(['status' => 'completed']);

        return back()->with('success', 'trening sacuvan uspesno');
    }  */
}
