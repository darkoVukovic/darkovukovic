<?php

namespace App\Http\Controllers;

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

        $existingExercise = GymProgress::where('user_id', Auth::id())->distinct()->pluck('tip_vezbe');
        return View('create',compact('existingExercise'));
    } 

    public function store (Request $request) {
    
        

    $request->validate([
        'Dan' => 'required|max:15',
        'max_tezina' => 'required|numeric',
        'ponavljanja' => 'required|numeric',
        'tip_vezbe' => 'required|max:25'
    ]);
    Auth::user()->gymProgress()->create($request->all());

    return redirect()->back()->with('success', 'Item created!');
    
    } 
}
