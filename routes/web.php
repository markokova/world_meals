<?php

use App\Http\Controllers\MealController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Meal;
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
//All Listings
Route::get('/', [MealController::class,'index']);  

//Single Listing
//Listing ENDPOINT
Route::get('/meals/{meal}', [MealController::class,'show']);

// Route::get('link za view', function ($id) {
//     return view('ime_viewa', [
//         sadržaj viewa - varijable, arrayevi...
//     ]);
// });