<?php

namespace App\Http\Controllers;

use App\Models\GymProgress;
use App\Models\TipVezbe;
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

        //$existingExercise = GymProgress::where('user_id', Auth::id())->distinct()->pluck('tip_vezbe');
        $existingExercise = GymProgress::where('user_id', Auth::id())
            ->with('tipVezbe')  // make sure GymProgress has: public function tipVezbe() { return $this->belongsTo(TipVezbe::class, 'tip_vezbe_id'); }
            ->get()
            ->pluck('tipVezbe.naziv')
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

    $tipVezbe = TipVezbe::firstOrCreate([
        'naziv' => $request->tip_vezbe,
        'muscle_group' => $request->muscle_group
     ]);



    //Auth::user()->gymProgress()->create($request->all());
    Auth::user()->gymProgress()->create([
        'Dan' => $request->Dan,
        'tip_vezbe_id' => $tipVezbe->id,
        'max_tezina' => $request->max_tezina,
        'ponavljanja' => $request->ponavljanja,
    ]);

    return redirect()->back()->with('success', 'Item created!');
    
    } 
}
