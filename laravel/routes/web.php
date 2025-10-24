<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Workouts;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\Dashboard;
use App\Livewire\Settings\Password;
use Illuminate\Contracts\View\View;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanerController;
use App\Models\GymProgress;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [Dashboard::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('workouts', [Workouts::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('workouts');

Route::get('workouts/create', [Workouts::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('workoutes.create');


Route::post('workouts/store', [Workouts::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('workouts.store');




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('home', [View::class, 'index']);


// planner routes

Route::get('planner', [PlanerController::class, 'index'])->name('planner');
Route::post('planner/add', [PlanerController::class, 'store'])->name('planner.store');
//Route::post('planner/complete/{planner}', [Workouts::class, 'storeFromPLanner'])->name('planner.complete');




Route::view('home', 'home')->name('about');
require __DIR__.'/auth.php';
