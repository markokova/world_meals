<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

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
        if($filters['tag'] ?? false) {
             $query->where('tags.title', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('status', 'like', '%' . request('search') . '%');
        }

        if($filters['status'] ?? false) {
            $query->where('status', 'like', '%' . request('status') . '%');
        }

        if($filters['category'] ?? false) {
            $query->where('category', 'like', '%' . request('category') . '%');
        }
    }
}
