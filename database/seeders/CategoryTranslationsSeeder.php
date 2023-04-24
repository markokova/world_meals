<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Category;
use \App\Models\CategoryTranslation;
class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $locales = ['en', 'fr', 'de'];
    
        foreach ($categories as $category) {
            foreach ($locales as $locale) {
                $existing_translation = CategoryTranslation::where('category_id', $category->id)
                    ->where('locale', $locale)
                    ->first();
                if(!$existing_translation){
                    $translation = CategoryTranslation::factory()->make();
                    $translation->locale = $locale;
                    $translation->category_id = $category->id;
                    $translation->save();
                }
            }
        }
    }
}
