<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
    
    // public function getTranslationsAttribute()
    // {
    //     return $this->translations()->get();
    // }

    // public function translations()
    // {
    //     return $this->hasMany(CategoryTranslation::class);
    // }
}