<?php

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
        $data = [
            [
                'name' => 'Шарлотка',
                'description' => 'Рецепт пользователя Сергея',
                'user_id' => 1
            ],
            [
                'name' => 'Пицца',
                'description' => 'Рецепт пользователя Сергея',
                'user_id' => 1
            ],
            [
                'name' => 'Гречка',
                'description' => 'Рецепт пользователя Александра',
                'user_id' => 2
            ],
            [
                'name' => 'Котлеты',
                'description' => 'Рецепт пользователя Александра',
                'user_id' => 2
            ]
        ];

        DB::table('recipes')->insert($data);
    }
}
