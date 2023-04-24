<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientTranslation extends Model
{
    use HasFactory;

    protected $table = 'ingredient_translations';

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);    
    }

    public $timestamps = false;
    protected $fillable = ['title'];
}
