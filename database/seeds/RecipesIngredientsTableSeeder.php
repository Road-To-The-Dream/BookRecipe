<?php

use Illuminate\Database\Seeder;

class RecipesIngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //recipe 1
            [
                'recipe_id' => 1,
                'ingredient_id' => 1,
                'amount' => '120 гр',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2,
                'amount' => '200 гр'
            ],
            //recipe 2
            [
                'recipe_id' => 2,
                'ingredient_id' => 2,
                'amount' => '100 гр'
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 3,
                'amount' => '300 гр'
            ],
            //recipe 3
            [
                'recipe_id' => 3,
                'ingredient_id' => 4,
                'amount' => '2 шт'
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 3,
                'amount' => '150 гр'
            ],
            //recipe 4
            [
                'recipe_id' => 4,
                'ingredient_id' => 5,
                'amount' => '200 гр'
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 6,
                'amount' => '100 гр'
            ],
        ];

        DB::table('recipes_ingredients')->insert($data);
    }
}
