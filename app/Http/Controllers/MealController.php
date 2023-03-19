<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
        // $tag = Tag::latest()->filter(request(['tag']))->get();
        // //dd($tag);
        // if($tag){
        //     $meals = $tag->meals;
        // }
        // else{
        //     $meals = Meal::all();
        // }
        // return view('meals.index', ['meals' => $meals]);

    //     $tag = Tag::where('title', request(['tag']))->first();
    //     dd( Tag::latest()->filter(request(['tag']))->get());
    //     $meals = Meal::all();
    //     if ($tag) {
    //         $meals = $tag->meals()->get();
    //         return view('meals.index', ['meals' => $meals]);
    //     } else {
    //         // Tag not found
    //     return view('meals.index', ['meals' => $meals]);
    // }
    //Show all listings
    public function index(){
        $tag_ids = null;
    if(request()->has('tag')){
        $tag_titles = explode(',', request('tag'));
        $tags = Tag::whereIn('title', $tag_titles)->get();
        $tag_ids = $tags->pluck('id')->toArray();
    }

    if($tag_ids){
        $meals = Meal::whereHas('tags', function($query) use ($tag_ids) {
            $query->whereIn('tag_id', $tag_ids);
        })->get();
    }
    else{
        $meals = Meal::latest()->get();
    }

            return view('meals.index', ['meals' => $meals]);


            
    //     $tag = Tag::latest()->filter(request(['tag']))->get();
    // $meals = Meal::whereHas('tags', function ($query) use ($tag) {
    //     $query->where('tags.id', $tag->id);
    // })->get();

    // return view('meals.index', compact('meals', 'tag'));
    }
         // $tag = Tag::latest()->filter(request(['tag']))->get();
        // //dd($tag);
        // return view('meals.index', [
        //     'meals' => Meal::whereHas('tags', function ($query) use ($tag) {
        //         $query->where('id', $tag->id);
        //     })->get()
        // ]);

    public function show(Meal $meal){
        return view('meals.show', [
            'meal' => $meal
    ]);
    }
}
