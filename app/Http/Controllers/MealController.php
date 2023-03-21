<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
    public function index(){
        $tag_ids = MealController::find_tags();

        $search = null;
        $meals = Meal::query();
        if(request()->has('search')){
            $search = request()->search;
            $meals->latest()->filter(request(['search']));
        }

        $meals = MealController::search_by_tags($tag_ids, $meals);

        $meals = MealController::search_by_status($meals);
        $meals = MealController::search_by_category($meals);

        if(!$search && !$tag_ids){
            $meals->latest();
        }
        $meals = MealController::meals_per_page($meals);
        
        return view('meals.index', ['meals' => $meals]);
    }

    protected function meals_per_page($meals){
        //default per_page value
        $per_page = 8;
        if(request()->has('per_page')){
            $per_page = request('per_page');
        }
        $meals = $meals->paginate($per_page);
        return $meals;
    }

    protected function find_tags(){
        $tag_ids = null;
        if(request()->has('tag')){
            $tag_title = request(['tag']);
            $tags = Tag::whereIn('title', $tag_title)->get();
            $tag_ids = $tags->pluck('id')->toArray();
        }
        return $tag_ids;
    }

    protected function search_by_tags($tag_ids, $meals){
        if($tag_ids){
            $meals->whereHas('tags', function ($query) use ($tag_ids) {
                $query->whereIn('tag_id', $tag_ids);
            });
        }
        return $meals;
    }

    protected function search_by_status($meals){
        $status = null;
        if(request()->has('status')){
            $status = request('status');
        }
        $meals->latest()->filter(request(['status']));
        return $meals;
    }

    protected function search_by_category($meals){
        $category = null;
        if(request()->has('category')){
            $category = request('category');
        }
        $meals->latest()->filter(request(['category']));
        return $meals;
    }

    public function show(Meal $meal){
        return view('meals.show', [
            'meal' => $meal
    ]);
    }
}