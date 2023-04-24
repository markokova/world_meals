<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Meal extends Model
{
    use HasFactory;

    public $translatedAttributes = ['title', 'description'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tag')->with('translations');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->with('translations');
    }

    public function translations()
    {
        return $this->hasMany(MealTranslation::class);
    }
}
