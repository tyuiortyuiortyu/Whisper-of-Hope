<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Whisper;
use App\Models\Color;

class WhisperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        $purple = Color::where('hex_value', '#d4d1eb')->first();
        $pink = Color::where('hex_value', '#f8bbd0')->first();
        $blue = Color::where('hex_value', '#d1e2f5')->first();
        $green = Color::where('hex_value', '#d4ebd1')->first();
        $orange = Color::where('hex_value', '#fbdbc9')->first();
        $lightPurple = Color::where('hex_value', '#e8d1eb')->first();

        $defaultWhispers = [
            [
                'to' => 'our loved one in the fight',
                'content' => 'You are seen, you are valued, and you are stronger than what you face. Don\'t lose sight of the fighter within.',
                'color_id' => $purple->id,
                'created_at' => now()->subDays(7)
            ],
            [
                'to' => 'all the fighters',
                'content' => 'you\'re stronger than u know',
                'color_id' => $pink->id,
                'created_at' => now()->subDays(6)
            ],
            [
                'to' => 'the heart that refuses to give up',
                'content' => 'You may not be where you want to be, but you\'re still here—and that matters more than you know.<br><br>Today, you\'re still here. That\'s enough.',
                'color_id' => $blue->id,
                'created_at' => now()->subDays(5)
            ],
            [
                'to' => 'You',
                'content' => 'Sending you love, light, and endless hope today.',
                'color_id' => $blue->id,
                'created_at' => now()->subDays(4)
            ],
            [
                'to' => 'you, little warrior',
                'content' => 'Even in weakness, you are strong. Every breath you take proves that your will is unbreakable.',
                'color_id' => $green->id,
                'created_at' => now()->subDays(3)
            ],
            [
                'to' => 'You',
                'content' => 'To those who stand by their loved ones: Your love is their armor. Thank you for being their light.',
                'color_id' => $purple->id,
                'created_at' => now()->subDays(2)
            ],
            [
                'to' => 'our young hero',
                'content' => 'You are stronger than you know, braver than you feel, and loved more than you can imagine. Keep fighting!<br><br>We\'re cheering for you every step of the way.',
                'color_id' => $orange->id,
                'created_at' => now()->subDay()
            ],
            [
                'to' => 'God\'s precious child',
                'content' => 'May God wrap you in His healing light, renew your strength each morning, and carry you through this storm. You\'re covered in prayer.',
                'color_id' => $lightPurple->id,
                'created_at' => now()
            ]
        ];

        foreach ($defaultWhispers as $whisper) {
            Whisper::create($whisper);
        }
    }
}
