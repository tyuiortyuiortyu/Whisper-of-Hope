<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('stories')->insert([
                'id'          => Str::uuid(),
                'title'       => 'Judul Cerita ' . $i,
                'image'       => 'placeholderStory.jpeg',
                'content'     => Str::limit('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 200),
                'category_id' => rand(1, 3), // Asumsikan sudah ada 5 kategori
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
}
