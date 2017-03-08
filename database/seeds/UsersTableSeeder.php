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
        DB::table('users')->delete();

        $users = array(
            ['id' => 1, 'name' => 'Joro', 'email' => 'joro@example.com', 'password' => bcrypt('password'), 'trusted' => 1],
            ['id' => 2, 'name' => 'Ivo', 'email' => 'ivo@example.com', 'password' => bcrypt('password'), 'trusted' => 0],
        );

        DB::table('users')->insert($users);
    }
}
