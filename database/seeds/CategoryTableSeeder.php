<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => config('constant.other'),
            'image' => 'default.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
