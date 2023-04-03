<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategorySeeder extends Seeder
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
                CategoryTranslation::create([
                    'locale' => $locale,
                    'category_id' => $category->id,
                    'title' => CategoryTranslation::definition()['title'],
                ]);
            }
        }
    }
}
