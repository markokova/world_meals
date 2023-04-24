<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model 
{
    use HasFactory;

    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
}