<?php

use App\Http\Controllers\Admin\FilmController;
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

    Route::get("dashboard/genres", function (){
        return dd("Halaman Home");
    })->name("genres.index");
});


