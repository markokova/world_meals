<?php

namespace App\Http\Controllers\Api;

use App\Models\Meal;
use App\Models\Tag;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
    protected $meals;

    public function index() {
        // $lang = request('lang', 'en'); //default language is English
        // $search = null;
        // $meals = Meal::query()->withTranslation($lang);
        $tag_ids = MealController::findTags();
        $this->meals = Meal::query();
        
        // if(request()->has('search')){
        //     $search = request()->search;
        //     $meals->latest()->filter(request(['search']));
        // }

        if(request()->has('tags') || request()->has('category') ||
         request()->has('lang') || request()->has('diff_time')) {
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
        //map meals to the expected data format
        $data = $this->meals->get()->map(function($meal) {
            return [
                'id' => $meal->id,
                'title' => $meal->title,
                'description' => $meal->description,
                'status' => $meal->status,
                'category' => $meal->category ? [
                'id' => $meal->category->id,
                // 'title' => $meal->category->translated('title'),
                'title' => $meal->category->title,
                'slug' => $meal->category->slug,
                ] : null,
                'tags' => $meal->tags->map(function($tag) {
                    return [
                        'id' => $tag->id,
                        // 'title' => $tag->translated('title'),
                        'title' => $tag->title,
                        'slug' => $tag->slug,
                    ];
                }),
                'ingredients' => $meal->ingredients->map(function($ingredient) {
                    return [
                        'id' => $ingredient->id,
                        // 'title' => $ingredient->translated('title'),
                        'title' => $ingredient->title,
                        'slug' => $ingredient->slug,
                    ];
                }),
            ];
        });
        return view('meals.index', ['data' => $data]);
    }

    protected function mealsPerPage() {
        $per_page = 8;//default per_page value
        if(request()->has('per_page')) {
            $per_page = request('per_page');
        }
        $this->meals->paginate($per_page);
    }

    protected function findTags() {
        $request_result = request('tags');
        $tags = null;
        if($request_result) {
            $tags = array_map('intval', explode(',', $request_result));
        }
        return $tags;
    }

    protected function filterByTags($tag_ids) {
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

    protected function filterByStatus() {
        if(request()->has('status')) {
            $this->meals->latest()->filter(request(['status']));
        }
    }

    protected function filterByCategory() {
        if(request()->has('category')) {
            $this->meals->latest()->filter(request(['category']));
        }
    }

    protected function filterByDiffTime(){
        if (is_numeric(request()->diff_time) && request()->diff_time > 0) {
            // Get the date that is diff_time seconds ago
            $diff_date = date('Y-m-d H:i:s', strtotime('-' . request()->diff_time . ' seconds'));
            // Select all meals that were created or modified  after $diff_date
            $this->meals->where('created_at', '>=', $diff_date)
                       ->orWhere('updated_at', '>=', $diff_date);
        }
    }
}
/*
validacija:
diff_time treba biti broj

*/