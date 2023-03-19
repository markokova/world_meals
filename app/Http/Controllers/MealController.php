<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
    //Show all listings
    public function index(){
        $tag_ids = null;
        if(request()->has('tag')){
            $tag_title = request(['tag']);
            $tags = Tag::whereIn('title', $tag_title)->get();
            $tag_ids = $tags->pluck('id')->toArray();
        }
        $search = null;
        $meals = array();
        if(request()->has('search')){
            $search = request()->search;
            $meals = Meal::latest()->filter(request(['search']))->get();
        }

        if($tag_ids){
            $meals = Meal::whereHas('tags', function($query) use ($tag_ids) {
                $query->whereIn('tag_id', $tag_ids);
            })->get();
        }
        else if(!$search){
            $meals = Meal::latest()->get();
        }
            return view('meals.index', ['meals' => $meals]);
    }

    private function search(){
        
    }

    public function show(Meal $meal){
        return view('meals.show', [
            'meal' => $meal
    ]);
    }
}