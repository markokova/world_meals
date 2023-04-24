<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //mislim da je create funkcija isto sto make i save zajedno
        //znaci make kreira objekt ali je potrebno save-at sa save() funkcijom
        //a create radi oba koraka odjednom
        
        //create 40 meals
        for($x=0; $x < 40; $x++){
            $category = \App\Models\Category::factory(1)->create();
            $meal = \App\Models\Meal::factory()->make();
            $meal->category_id = $category->first()->id;
            $meal->save();
            $tags = \App\Models\Tag::factory(3)->create();
            $meal->tags()->attach($tags->pluck('id')->toArray());
            $ingredients = \App\Models\Ingredient::factory(4)->create();
            $meal->ingredients()->attach($ingredients->pluck('id')->toArray());
          }
    }
}
