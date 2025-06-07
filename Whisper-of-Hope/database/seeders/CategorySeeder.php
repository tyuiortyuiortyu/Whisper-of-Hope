<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('categories')->truncate();
        DB::table('categories')->insert([
            ['name' => 'Blog'],
            ['name' => 'Children’s Hair Donation Stories'],
            ['name' => 'Hair Donation Stories'],
        ]);
    }
}
