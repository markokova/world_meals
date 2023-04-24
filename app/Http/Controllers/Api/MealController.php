<?php

namespace App\Http\Controllers\Api;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Filters\MealFilter;

class MealController extends Controller
{
    protected $meals;
    protected $filtered_items_num;
    protected $lang;
    protected $meal_filter;

    public function __construct(MealFilter $meal_filter)
    {
        $this->meal_filter = $meal_filter;
    }

    public function index() 
    {
        $filter_results = $this->meal_filter->filter();
        
        $this->meals = $filter_results['meals'];
        $this->lang = $filter_results['lang'];

        $this->filtered_items_num = $this->meals->count();

        if($this->meals == null) {
            return view('meals.index', ['meta' => null, 'data' => $this->meals]);             
        }
        else{
            MealController::paginateMeals();
        }

        $result = MealController::adjustData();

        return view('meals.index', $result);
    }

    protected function paginateMeals() 
    {
        $per_page = 8; //default per_page value
        if(request()->has('per_page')) {
            $per_page = request('per_page');
        }
        $this->meals->paginate($per_page);
    }

    protected function adjustData(){
        //map meals to the expected data format   
        $page = 1; //default page value
        if(request()->has('page')){
            $page = request('page');
        }
        $per_page = 8; //default per_page value
        if(request()->has('per_page')){
            $per_page = request('per_page');
        }
        $meta_data = array(
            "meta" => array(
                "currentPage" => $page,
                "totalItems" => $this->filtered_items_num,
                "itemsPerPage" => $per_page,
                "totalPages" => ceil($this->filtered_items_num/$per_page)
            )
            );
        $data = $this->meals->get()->map(function($meal) {
            return [
                'id' => $meal->id,
                'title' => $meal->meal_title,
                'description' => $meal->meal_description,
                'status' => $meal->status,
                'category' => $meal->category ? [
                'id' => $meal->category->id,
                'title' => $meal->category_title,
                'slug' => $meal->category->slug,
                ] : null,
                'tags' => $meal->tags->map(function($tag) {
                    return [
                        'id' => $tag->id,
                        'title' => $tag->translations->where('locale', $this->lang)->first()->title,
                        'slug' => $tag->slug,
                    ];
                }),
                'ingredients' => $meal->ingredients->map(function($ingredient) {
                    return [
                        'id' => $ingredient->id,
                        'title' => $ingredient->translations->where('locale', $this->lang)->first()->title,
                        'slug' => $ingredient->slug,
                    ];
                }),
            ];
        });
        return ["meta" => $meta_data, "data" => $data];
    }
}