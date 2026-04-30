<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('categories')->insert([
        ['category_name' => 'UI/UX Design'],
        ['category_name' => 'Web Development'],
        ['category_name' => 'Data Science'],
        ['category_name' => 'Frontend Development'],
        ['category_name' => 'Backend Development'],
      ]);
    }
}
