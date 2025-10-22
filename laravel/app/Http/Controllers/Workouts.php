<?php

namespace App\Http\Controllers;

use App\Models\gym_progress;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Workouts extends Controller
{
    


    public function  index () {


            return View('workouts');

    }
    
    public function create (): View {

        return View('create');
    } 

    public function store (Request $request) {

    $request->validate([
        'Dan' => 'required|max:15',
        'max_tezina' => 'required|numeric',
        'ponavljanja' => 'required|numeric',
        'tip_vezbe' => 'required|max:25'
    ]);
        
    gym_progress::create($request->all());

    return redirect()->back()->with('success', 'Item created!');
    
    } 
}
