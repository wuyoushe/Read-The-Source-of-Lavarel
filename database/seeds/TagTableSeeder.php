<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table')->insert([
           ['title' => 'MYSQL', 'sort'=>0],
           ['title'=>'Laravel', 'sort'=>0],
            ['title' => 'Yii', 'sort'=>0],
            ['title' => 'ThinkPHP', 'sort'=>0],
            ['title' => 'PHP7', 'sort'=>0],
            ['title' => 'nginx', 'sort'=>0],
            ['title' => 'redis', 'sort'=>0],
        ]);
        //
    }
}
