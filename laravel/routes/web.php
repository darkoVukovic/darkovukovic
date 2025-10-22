<?php

use App\Http\Controllers\Home;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Workouts;

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

Route::view('home', 'home')->name('about');
require __DIR__.'/auth.php';
