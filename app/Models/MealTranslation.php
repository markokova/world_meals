<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;



class MealTranslation extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
