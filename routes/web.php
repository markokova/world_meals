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
Route::get('/', [MealController::class,'index']);  

// Search Form, Per Page Form
Route::post('/', [MealController::class,'index']);  

Route::get('/meals/{meal}', [MealController::class,'show']);

