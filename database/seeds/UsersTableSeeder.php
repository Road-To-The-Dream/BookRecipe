<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Сергей',
                'email' => 'fhlbc2012@gmail.com',
                'password' => bcrypt('password1')
            ],
            [
                'name' => 'Александр',
                'email' => 'test@gmail.com',
                'password' => bcrypt('password2')
            ]
        ];

        DB::table('users')->insert($data);
    }
}
