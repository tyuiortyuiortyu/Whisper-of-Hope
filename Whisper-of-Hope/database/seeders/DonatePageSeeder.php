<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\DonateHair;
use App\Models\User;

class DonatePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'seeder@example.com'], 
            [
                'name' => 'Seeder User',
                'password' => bcrypt('password'),
            ]
        );

        $donationRecords = [
            [
                'id' => 'DH001',
                'user_id' => $user->id,
                'full_name' => 'John Doe',
                'age' => '71',
                'email' => 'johnd@gmail.com',
                'phone' => '08123456789',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10)
            ],
            [
                'id' => 'DH002',
                'user_id' => $user->id,
                'full_name' => 'Jane Doe',
                'age' => '11',
                'email' => 'parent_email@example.com',
                'phone' => '081211112222', 
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            [
                'id' => 'DH003',
                'user_id' => $user->id,
                'full_name' => 'Joe',
                'age' => '16',
                'email' => 'professional_email@example.com',
                'phone' => '081233334444',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
            [
                'id' => 'DH004',
                'user_id' => $user->id,
                'full_name' => 'Alice',
                'age' => '31',
                'email' => 'alice@gmail.com',
                'phone' => '08123456790',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3)
            ],
            [
                'id' => 'DH005',
                'user_id' => $user->id,
                'full_name' => 'Ben',
                'age' => '5',
                'email' => 'benparent@gmail.com',
                'phone' => '08123456783',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7)
            ],
            [
                'id' => 'DH006',
                'user_id' => $user->id,
                'full_name' => 'Judy',
                'age' => '27',
                'email' => 'judydoc@gmail.com',
                'phone' => '08123456784',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
            [
                'id' => 'DH007',
                'user_id' => $user->id,
                'full_name' => 'Nancy',
                'age' => '21',
                'email' => 'nancy@gmail.com',
                'phone' => '08123456786',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25)
            ],
            [
                'id' => 'DH008',
                'user_id' => $user->id,
                'full_name' => 'Grace',
                'age' => '7',
                'email' => 'graceguardian@gmail.com',
                'phone' => '08123456787',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(51),
                'updated_at' => now()->subDays(51)
            ],
            [
                'id' => 'DH009',
                'user_id' => $user->id,
                'full_name' => 'Victor',
                'age' => '38',
                'email' => 'victordoc@gmail.com',
                'phone' => '08123456788',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(173),
                'updated_at' => now()->subDays(173)
            ],
            [
                'id' => 'DH010',
                'user_id' => $user->id,
                'full_name' => 'Zoe',
                'age' => '33',
                'email' => 'zoe@gmail.com',
                'phone' => '08123456791',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(78),
                'updated_at' => now()->subDays(78)
            ],
            [
                'id' => 'DH011',
                'user_id' => $user->id,
                'full_name' => 'Hannah',
                'age' => '16',
                'email' => 'hannahparent@gmail.com',
                'phone' => '08123456780',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(256),
                'updated_at' => now()->subDays(256)
            ],
            [
                'id' => 'DH012',
                'user_id' => $user->id,
                'full_name' => 'Chris',
                'age' => '18',
                'email' => 'chrisdoc@gmail.com',
                'phone' => '08123456781',
                'hair_length' => '30',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
        ];

        foreach ($donationRecords as $record) {
            // First check if record exists
            $existing = DB::table('hair_donations')->where('id', $record['id'])->first();
            if (!$existing) {
                // Create new record using insert to bypass model events
                DB::table('hair_donations')->insert($record);
            }
        }
    }
}