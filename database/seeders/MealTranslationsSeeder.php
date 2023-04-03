<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\MealTranslation;

class MealTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meals = Meal::all();
        $locales = ['en', 'fr', 'de'];
    
        foreach ($meals as $meal) {
            foreach ($locales as $locale) {
                MealTranslation::create([
                    'locale' => $locale,
                    'meal_id' => $meal->id,
                    'title' => MealTranslation::definition()['title'],
                    'description' => MealTranslation::definition(['description']),
                ]);
            }
        }
    }
}
