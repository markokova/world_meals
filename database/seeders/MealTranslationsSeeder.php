<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\MealTranslation;
use Database\Factories\MealTranslationFactory;

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
                // Check if a translation already exists for this meal and locale
                $existingTranslation = MealTranslation::where('meal_id', $meal->id)
                ->where('locale', $locale)
                ->first();

                // If no translation exists, create a new one
                if (!$existingTranslation) {
                    $translation = MealTranslation::factory()->make();
                    $translation->locale = $locale;
                    $translation->meal_id = $meal->id;
                    $translation->save();
                }
            }
        }
    }
}
