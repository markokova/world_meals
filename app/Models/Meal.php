<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Meal extends Model implements TranslatableContract 
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['title', 'description'];
      
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tag');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('status', 'like', '%' . request('search') . '%');
        }
        //status ne radi iz nekog razloga
        if($filters['status'] ?? false) {
            $query->where('status', 'like', '%' . request('status') . '%');
        }

        if($filters['category'] ?? false) {
            $query->where('category_id', 'like', '%' . request('category') . '%');
        }
    }
}
