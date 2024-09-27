<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
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

Route::get('/', function () {
    return view('welcome');
});

// Register
//Route::get ("register",[Authcontroller ::class, "register"])->name("register");
//Route::post ("register",[Authcontroller ::class, "register"])->name("register");

Route:: match (["get","post"],"register", [Authcontroller::class, "register"])->name("register");

// Login
//Route::get ("login",[Authcontroller ::class, "login"])->name("login");
Route:: match (["get","post"],"login", [Authcontroller::class, "login"])->name("login");


//dashboard
Route::get ("dashboard",[Authcontroller ::class, "dashboard"])->name("dashboard");

//profile 
//Route::get ("profile",[Authcontroller ::class, "profile"])->name("profile");
Route:: match (["get","post"],"profile", [Authcontroller::class, "profile"])->name("profile");

//logout
Route::get ("logout",[Authcontroller ::class, "logout"])->name("logout");