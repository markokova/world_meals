<?php

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
Route::get('/', function () {
    return view('meals', [
        'heading' => 'Latest Meals',
        'meals' => Meal::all()
    ]);
});  

//Single Listing
//Listing ENDPOINT
Route::get('/meals/{id}', function ($id) {
    return view('meal', [
        'meal' => Meal::find($id)
    ]);
});

// Route::get('link za view', function ($id) {
//     return view('ime_viewa', [
//         sadržaj viewa - varijable, arrayevi...
//     ]);
// });