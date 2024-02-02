<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FrontPageContentController;
use App\Http\Controllers\SearchController;
use App\Models\Category;
use App\Models\FrontPageContent;
use App\Models\Location;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome' , ['frontPage' => FrontPageContent::first() , 'locations' => Location::all() , 'categories' => Category::all()]);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth','verified'])->group(function(){
    Volt::route('home','pages.home')->name('home');
});

Route::get('/f/{facility}' , [FacilityController::class , 'show'])->name('facilities.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('search', [SearchController::class,'index'])->name('search');

require __DIR__.'/auth.php';
