<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_tag');
    }

    public function scopeFilter($query, $filter){
        if($filter ?? false) {
            $query->where('tags.title', 'like', '%' . $filter . '%');
            }
    }
}
