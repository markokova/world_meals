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
                TagTranslation::create([
                    'locale' => $locale,
                    'tag_id' => $tag->id,
                    'title' => TagTranslation::definition()['title'],
                ]);
            }
        }
    }
}
