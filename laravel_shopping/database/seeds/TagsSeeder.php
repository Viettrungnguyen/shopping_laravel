<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name' => 'abc',
            ],
            [
                'name' => 'def'
            ]
        ];
        DB::table('tags')->insert($tags);
    }
}
