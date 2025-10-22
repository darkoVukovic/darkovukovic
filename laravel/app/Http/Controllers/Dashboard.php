<?php

namespace App\Http\Controllers;


use App\Models\gym_progress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class Dashboard extends Controller
{
    public function index ():View {
        
        $monday    = Gym_progress::where('Dan', 'Ponedeljak')->latest('created_at')->first();
        $tuesday   = Gym_progress::where('Dan', 'Utorak')->latest('created_at')->first();
        $wednesday = Gym_progress::where('Dan', 'Sreda')->latest('created_at')->first();
        $thursday  = Gym_progress::where('Dan', 'Cetvrtak')->latest('created_at')->first();
        $friday    = Gym_progress::where('Dan', 'Petak')->latest('created_at')->first();

        
        $weekSummary = collect([$monday,$tuesday, $wednesday, $thursday, $friday])->filter();
    
       return View('dashboard', compact(
    'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'weekSummary'
));
    } 


}
