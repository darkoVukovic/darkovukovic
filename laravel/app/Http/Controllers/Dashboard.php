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
        $userId = Auth::id();

      //  $monday    = GymProgress::where('Dan', 'Ponedeljak')->latest('created_at')->first();
      //  $tuesday   = GymProgress::where('Dan', 'Utorak')->latest('created_at')->first();
      //  $wednesday = GymProgress::where('Dan', 'Sreda')->latest('created_at')->first();
      //  $thursday  = GymProgress::where('Dan', 'Cetvrtak')->latest('created_at')->first();
      //  $friday    = GymProgress::where('Dan', 'Petak')->latest('created_at')->first();

      $monday = GymProgress::where('user_id', $userId)
        ->where('Dan', 'Ponedeljak')
        ->where('created_at', '>=', $startOfWeek)
        ->with('tip_vezbe')
        ->latest('created_at')
        ->get()
        ->groupBy(fn($progress) => ucfirst(strtolower($progress->tip_vezbe->muscle_group)));


        $tuesday = GymProgress::where('user_id', $userId)
        ->where('Dan', 'Utorak')
        ->where('created_at', '>=', $startOfWeek)
        ->with('tip_vezbe')
        ->latest('created_at')
        ->get()
        ->groupBy(fn($progress) => $progress->tip_vezbe->muscle_group);


        $wednesday = GymProgress::where('user_id', $userId)
        ->where('Dan', 'Sreda')
        ->where('created_at', '>=', $startOfWeek)
        ->with('tip_vezbe')
        ->latest('created_at')
        ->get()
        ->groupBy(fn($progress) => $progress->tip_vezbe->muscle_group);

        $thursday = GymProgress::where('user_id', $userId)
        ->where('Dan', 'Cetvrtak')
        ->where('created_at', '>=', $startOfWeek)
        ->with('tip_vezbe')
        ->latest('created_at')
        ->get()
        ->groupBy(fn($progress) => $progress->tip_vezbe->muscle_group);


        $friday = GymProgress::where('user_id', $userId)
        ->where('Dan', 'Petak')
        ->where('created_at', '>=', $startOfWeek)
        ->with('tip_vezbe')
        ->latest('created_at')
        ->get()
        ->groupBy(fn($progress) => $progress->tip_vezbe->muscle_group);


          $today = Carbon::today();
        

       $endOfWeek = $today->copy()->endOfWeek();

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

      
       return View('dashboard', compact(
    'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'weeklyPlans', 'completed'));
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
