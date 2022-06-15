<?php

use App\Http\Controllers\Admin\ChairCategoryController;
use App\Http\Controllers\Admin\ChairController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware("guest")->group(function(){
    
});

Auth::routes();


Route::middleware("auth")->group(function(){
    Route::get('/', [HomeController::class, "index"])->name('home');
    Route::get('/dashboard', function (){
        return view("admin.index", ["title" => "data"]);
    })->name('dashboard');
    
    Route::resource("/dashboard/films", FilmController::class);
    Route::resource("/dashboard/rooms", RoomController::class);
    Route::resource("/dashboard/schedules", ScheduleController::class);
    Route::resource("/dashboard/rooms", RoomController::class);
    Route::resource("/dashboard/genres", GenreController::class)->except(['show']);
    Route::resource('/dashboard/chair-categories', ChairCategoryController::class)->except(['show']);
    Route::resource('/dashboard/chairs', ChairController::class)->except(['show']);
});


