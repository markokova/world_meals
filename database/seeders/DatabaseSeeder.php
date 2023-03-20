<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void 
    {
        //create 10 users
          \App\Models\User::factory(10)->create();
          //create 20 meals
          for($x=0; $x < 40; $x++){
            $category = \App\Models\Category::factory(1)->create();
            $meal = \App\Models\Meal::factory()->make();
            $meal->category_id = $category->first()->id;
            $meal->save();
            $tags = \App\Models\Tag::factory(3)->create();
            $meal->tags()->attach($tags->pluck('id')->toArray());
            $ingredients = \App\Models\Ingredient::factory(4)->create();
            $meal->ingredients()->attach($ingredients->pluck('id')->toArray());
            //$meal = \App\Models\Meal::factory(1);
            //$meal['category_id'] = $category->id;
            //$meal->create();
          }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
