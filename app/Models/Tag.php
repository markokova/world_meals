<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $translatedAttributes = ['title'];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_tag');
    }

    public function translations()
    {
        return $this->hasMany(TagTranslation::class);
    }
}
