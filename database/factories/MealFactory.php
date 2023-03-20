<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Tag;

/*
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(5),
            'status' => $this->faker->randomElement(['created','published','archived']),
            'category_id' => 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Meal $meal) {
            $tags = Tag::factory()->count(2)->create();
            $meal->tags()->attach($tags);

            $ingredients = Ingredient::factory()->count(3)->create();
            $meal->ingredients()->attach($ingredients);

            $meal->save();
            $tags->save();
            $ingredients->save();
        });
    }
}
