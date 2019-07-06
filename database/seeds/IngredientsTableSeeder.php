<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Огурец'],
            ['name' => 'Помидор'],
            ['name' => 'Перец'],
            ['name' => 'Соль'],
            ['name' => 'Сыр'],
            ['name' => 'Колбаса']
        ];

        DB::table('ingredients')->insert($data);
    }
}
