<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;
    use Translatable;
    
    public $timestamps = false;
    protected $fillable = ['title'];
    public $translatedAttributes = ['title'];
}
