<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Pink', 'hex_value' => '#f8bbd0', 'font_color' => '#753753'],
            ['name' => 'Orange', 'hex_value' => '#fbdbc9', 'font_color' => '#753C37'],
            ['name' => 'Green', 'hex_value' => '#d4ebd1', 'font_color' => '#377558'],
            ['name' => 'Blue', 'hex_value' => '#d1e2f5', 'font_color' => '#375375'],
            ['name' => 'Purple', 'hex_value' => '#d4d1eb', 'font_color' => '#374375'],
            ['name' => 'Light Purple', 'hex_value' => '#e8d1eb', 'font_color' => '#374375'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
