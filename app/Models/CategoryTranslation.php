<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class CategoryTranslation extends Model
{
    use HasFactory;
    use Translatable;

    public $translationModel = 'CategoryTranslation'; 

    public $timestamps = false;
    protected $fillable = ['title'];
    public $translatedAttributes = ['title'];

        
}
