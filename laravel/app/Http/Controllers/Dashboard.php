<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Planner;
use App\Models\GymProgress;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index ():View {
        
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek   = Carbon::now()->endOfWeek();  

        $userId = Auth::id();


    $allProgress = GymProgress::where('user_id', $userId)
        ->whereBetween('Dan', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
        ->with('tip_vezbe')
        ->latest('Dan')
        ->get();
    $byDay = $allProgress->groupBy(fn($p) => Carbon::parse($p->Dan)->dayOfWeek);

    $groupByMuscle = fn($day) => ($byDay->get($day) ?? collect())
    ->groupBy(fn($p) => ucfirst(strtolower($p->tip_vezbe->muscle_group)));

    $monday    = $groupByMuscle(1);
    $tuesday   = $groupByMuscle(2);
    $wednesday = $groupByMuscle(3);
    $thursday  = $groupByMuscle(4);
    $friday    = $groupByMuscle(5);
    $saturday  = $groupByMuscle(6);
    $sunday    = $groupByMuscle(0);
      
       // Get this week's planned workouts
      
    
    
      $weeklyPlans = Planner::where('user_id', $userId)
                      ->whereBetween('planned_date', [$startOfWeek, $endOfWeek])
                      ->with('tip_vezbe')
                      ->get();


// Get completed workouts this week

    $completed = GymProgress::where('user_id', $userId)
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->get()
                        ->keyBy(fn($p) =>  strtolower($p->tip_vezbe->naziv)); // lowercase key

      
     return view('dashboard', compact(
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
        'weeklyPlans', 'completed'
    ));
    
    } 


 public function destroy(GymProgress $progress) {
    // Make sure the logged-in user owns this entry
    if ($progress->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $progress->delete();
    
    return redirect()->back()->with('success', 'Vežba obrisana.');
  }

}
