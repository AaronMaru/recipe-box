<?php

use App\Recipe;
use App\RecipeDirection;
use App\RecipeIngredient;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        RecipeDirection::truncate();
        RecipeIngredient::truncate();
        Recipe::truncate();

        foreach (range(1, 10) as $i) {
            $recipe = Recipe::create([
                'user_id'     => $i,
                'name'        => $faker->sentence,
                'description' => $faker->paragraph(mt_rand(5, 15)),
                'image'       => 'test.png'
            ]);
        }

        foreach (range(1, mt_rand(3, 12)) as $j) {
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'name'      => $faker->word,
                'qty'       => mt_rand(1, 12) . 'kg'
            ]);
        }

        foreach (range(1, mt_rand(5, 12)) as $k) {
            RecipeDirection::create([
                'recipe_id'   => $recipe->id,
                'description' => $faker->sentence
            ]);
        }
    }
}
