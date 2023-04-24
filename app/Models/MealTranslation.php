<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class MealTranslation extends Model
{
    use HasFactory;

    protected $table = 'meal_translations';

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public $timestamps = false;
    protected $fillable = ['title', 'description'];
    public $translatedAttributes = ['title', 'description'];
}
