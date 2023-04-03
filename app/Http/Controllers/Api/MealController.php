<?php

namespace App\Http\Controllers\Api;

use App\Models\Meal;
use App\Models\Tag;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
    protected $meals;

    public function index() 
    {
        MealController::filterByLang();

        if(request()->has('tags') || request()->has('category') || request()->has('status') 
        || request()->has('lang') || request()->has('diff_time')) {
            $tag_ids = MealController::findTags();
            MealController::filterByTags($tag_ids);
            if($this->meals == null) {
                $this->meals = array();
                return view('meals.index', ['dataa' => $this->meals]);             
            }
            MealController::filterByStatus();
            MealController::filterByCategory();
            MealController::filterByDiffTime();
        } else{
            //fetch all meals
            $this->meals->latest();
        }

        if($this->meals != null) {
            //paginate
            MealController::mealsPerPage();
        }

        $result = MealController::adjustData();

        return view('meals.index', $result);
    }

    protected function mealsPerPage() 
    {
        $per_page = 8;//default per_page value
        if(request()->has('per_page')) {
            $per_page = request('per_page');
        }
        $this->meals->paginate($per_page);
    }

    protected function findTags() 
    {
        $request_result = request('tags');
        $tags = null;
        if($request_result) {
            $tags = array_map('intval', explode(',', $request_result));
        }
        return $tags;
    }

    protected function filterByTags($tag_ids) 
    {
        if(request()->has('tags')) {
            $tags = Tag::find($tag_ids);
            $tag_count_in_request = count($tag_ids);
            $count_found_tags = count($tags);
            if($tag_count_in_request == $count_found_tags) {
                foreach ($tags as $tag) {
                    $this->meals->whereHas('tags', function($query) use ($tag) {
                        $query->where('tags.id', $tag->id);
                    });
                }
            } else {
                $this->meals = null;
            }
        }
    }

    protected function filterByStatus() 
    {
        if(request()->has('status')) {
            $this->meals->latest()->filter(request(['status']));
        }
    }

    protected function filterByCategory()
    {
        if(request()->has('category')) {
            $this->meals->latest()->filter(request(['category']));
        }
    }

    protected function filterByDiffTime()
    {
        if (is_numeric(request()->diff_time) && request()->diff_time > 0) {
            // T the date that is diff_time seconds ago
            $diff_date = date('Y-m-d H:i:s', strtotime('-' . request()->diff_time . ' seconds'));
            // Select all meals that were created or modified  after $diff_date
            $this->meals->where('created_at', '>=', $diff_date)
                       ->orWhere('updated_at', '>=', $diff_date);
        }
    }

    protected function filterByLang(){
        $lang = request('lang');
        //default language is English
        if(!$lang){
            $lang = 'en';
        } 

        if($lang != 'en'){
            //find only the meals which are translated into $lang
            $this->meals = Meal::query()->withTranslation($lang)->whereHas('translations', function ($query) use ($lang) {
                $query->where('locale', $lang);
            });
        } else{
            $this->meals = Meal::query();
        }
    }

    protected function adjustData(){
        //map meals to the expected data format   
        $page = 1;
        if(request()->has('page')){
            $page = request('page');
        }
        $per_page = 8;
        if(request()->has('per_page')){
            $per_page = request('per_page');
        }
        $meals_total_num = count(Meal::all());
        $meta_data = array(
            "meta" => array(
                "currentPage" => $page,
                "totalItems" => $meals_total_num,
                "itemsPerPage" => $per_page,
                "totalPages" => ceil($meals_total_num/$per_page)
            )
            );
        $data = $this->meals->get()->map(function($meal) {
            return [
                'id' => $meal->id,
                'title' => $meal->title,
                // 'title' => $meal->getTranslation('title', request('lang')),
                'description' => $meal->description,
                'status' => $meal->status,
                'category' => $meal->category ? [
                'id' => $meal->category->id,
                'title' => $meal->category->title,
                // 'title' => $meal->category->getTranslation('title', request('lang')),
                'slug' => $meal->category->slug,
                ] : null,
                'tags' => $meal->tags->map(function($tag) {
                    return [
                        'id' => $tag->id,
                        // 'title' => $tag->getTranslation('title', request('lang')),
                        'title' => $tag->title,
                        'slug' => $tag->slug,
                    ];
                }),
                'ingredients' => $meal->ingredients->map(function($ingredient) {
                    return [
                        'id' => $ingredient->id,
                        // 'title' => $ingredient->getTranslation('title', request('lang')),
                        'title' => $ingredient->title,
                        'slug' => $ingredient->slug,
                    ];
                }),
            ];
        });
        return ["meta" => $meta_data, "data" => $data];
    }
}
/*
validacija:
diff_time treba biti broj

*/