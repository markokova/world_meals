<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;
    
    protected $table = 'tag_translations';

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public $timestamps = false;
    protected $fillable = ['title'];
    public $translatedAttributes = ['title'];
}
