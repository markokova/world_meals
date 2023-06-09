<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientTranslation;

class IngredientTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = Ingredient::all();
        $locales = ['en', 'fr', 'de'];
    
        foreach ($ingredients as $ingredient) {
            foreach ($locales as $locale) {
                $existing_translation = IngredientTranslation::where('ingredient_id', $ingredient->id)
                    ->where('locale', $locale)
                    ->first();
                if(!$existing_translation){
                    $translation = IngredientTranslation::factory()->make();
                    $translation->locale = $locale;
                    $translation->ingredient_id = $ingredient->id;
                    $translation->save();
                }
            }
        }
    }
}
