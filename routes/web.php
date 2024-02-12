<?php

use App\Http\Controllers\ExploreController;
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

Route::get('/', [FrontPageContentController::class , 'index'])->name('home');

Volt::route('explore' , 'pages.explore')->name('explore');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('/f/{facility}' , 'facilities.show')->name('facilities.show');
Volt::route('/bookings' , 'bookings.index')->middleware('auth')->name('bookings.index');
Volt::route('/my-space' , 'myspace.index')->middleware('auth')->name('myspace.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('search', [SearchController::class,'index'])->name('search');

require __DIR__.'/auth.php';
