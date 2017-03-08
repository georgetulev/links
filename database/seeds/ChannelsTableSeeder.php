<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->delete();

        $channels = array(
            ['id' => 1, 'title' => 'PHP', 'slug' => 'php', 'color' => 'blue'],
            ['id' => 2, 'title' => 'JavaScript', 'slug' => 'javascript', 'color' => 'green'],
            ['id' => 3, 'title' => 'C#', 'slug' => 'c-sharp', 'color' => 'red']
        );

        DB::table('channels')->insert($channels);
    }
}
