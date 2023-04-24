<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\TagTranslation;


class TagTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        $locales = ['en', 'fr', 'de'];
    
        foreach ($tags as $tag) {
            foreach ($locales as $locale) {
                $existing_translation = TagTranslation::where('tag_id', $tag->id)
                    ->where('locale', $locale)
                    ->first();
                if(!$existing_translation){
                $translation = TagTranslation::factory()->make();
                $translation->locale = $locale;
                $translation->tag_id = $tag->id;
                $translation->save();
                }
            }
        }
    }
}
