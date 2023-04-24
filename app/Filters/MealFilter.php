<?php

namespace App\Filters;

use App\Models\Tag;
use App\Models\Meal;

class MealFilter
{
    protected $meals;
    protected $lang;

    public function filter(){
        MealFilter::filterByLang();
        $tag_ids = MealFilter::findTags();
        MealFilter::filterByTags($tag_ids);
        MealFilter::filterByStatus();
        MealFilter::filterByCategory();
        MealFilter::filterByDiffTime();
        
        return ['meals' => $this->meals,
                'lang' => $this->lang];
    }

    protected function findTags() 
    {
        if(request('tags')) {
            return array_map('intval', explode(',', request('tags')));
        }
        return null;
    }

    protected function filterByTags($tag_ids) 
    {
        if(request()->has('tags')) {
            $tags = Tag::find($tag_ids);
            $tag_count_in_request = count($tag_ids);
            $found_tags_count = count($tags);
            if($tag_count_in_request === $found_tags_count){
                foreach ($tags as $tag) {
                    $this->meals->whereHas('tags', function($query) use ($tag) {
                        $query->where('tags.id', $tag->id);
                    });
                }    
            }
            else{
                //No meals should be returned
                $this->meals->where('meals.id', '<', 0);
            }
        }
    }

    protected function filterByStatus() 
    {
        if(request('status')){
            $this->meals->where('status',request('status'));
        }
    }

    protected function filterByCategory()
    {
        if(request('category')){
            $this->meals->where('meals.category_id', request('category'));
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
        $this->lang = request('lang');
        //default language is English
        if(!$this->lang){
            $this->lang = 'en';
        }
            $lang = $this->lang;
            $this->meals = Meal::query()
            ->select(
                'meals.*', 
                'mt.title as meal_title', 
                'mt.description as meal_description',
                'ct.title as category_title'
            )
            ->leftJoin('meal_translations as mt', function ($join) use ($lang) {
                $join->on('meals.id', '=', 'mt.meal_id')
                    ->where('mt.locale', $lang);
            })
            ->leftJoin('category_translations as ct', function ($join) use ($lang) {
                $join->on('meals.category_id', '=', 'ct.category_id')
                    ->where('ct.locale', $lang);
            })
            ->whereHas('translations', function ($query) use ($lang) {
                $query->where('locale', $lang);
            })
            ->with(['ingredients.translations', 'tags.translations']);
    }
}