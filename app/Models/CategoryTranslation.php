<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    public $translationModel = 'CategoryTranslation'; 
    protected $table = 'category_translations';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public $timestamps = false;
    protected $fillable = ['title'];
    public $translatedAttributes = ['title'];

        
}
