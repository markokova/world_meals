<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryTranslation;
use App\Models\MealTranslation;
use App\Models\TagTranslation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void 
    {

      $this->call([
        MealSeeder::class,
        MealTranslationsSeeder::class,
        CategoryTranslationsSeeder::class,
        IngredientTranslationsSeeder::class,
        TagTranslationsSeeder::class
      ]);
      //create 10 users
      \App\Models\User::factory(10)->create();
    }
}
