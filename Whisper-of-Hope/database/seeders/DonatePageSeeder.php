<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use App\Models\User;

class DonatePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_requests')->truncate();
        $user = User::firstOrCreate(
            ['email' => 'seeder@example.com'], 
            [
                'name' => 'Seeder User',
                'password' => bcrypt('password'),
            ]
        );

        // Opsional: Hapus data lama dari tabel hair_requests sebelum seeding
        DB::table('hair_donations')->truncate(); 

        $donationRecords = [
            [
                'full_name' => 'John Doe',
                'age' => '71',
                'email' => 'johnd@gmail.com',
                'phone' => '08123456789',
                'hair_length' => '30', // Tambahkan kolom hair_length
                'status' => 'waiting',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10)
            ],
            [
                'full_name' => 'Jane Doe', // Ini adalah nama penerima request
                'age' => '11',
                'email' => 'parent_email@example.com', // Asumsi ada email/phone di tabel utama
                'phone' => '081211112222', 
                'hair_length' => '30', // Tambahkan kolom hair_length
                'status' => 'waiting',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            // Data untuk 'health_professional' (sesuai dengan kolom full_name, age, email, phone)
            [
                'full_name' => 'Joe', // Nama penerima request
                'age' => '16',
                'email' => 'professional_email@example.com', // Asumsi ada email/phone di tabel utama
                'phone' => '081233334444',
                'hair_length' => '30', // Tambahkan kolom hair_length
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
            [
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

        $counter = 1;
        foreach ($donationRecords as $record) {
            // Generate ID dengan format DHXXX
            $requestId = 'DH' . Str::padLeft($counter, 3, '0');

            
            DB::table('hair_donations')->insert([
                'id' => $requestId,
                'user_id' => $user->id,
                'full_name' => $record['full_name'],
                'age' => $record['age'],
                'email' => $record['email'],
                'phone' => $record['phone'],
                'hair_length' => $record['hair_length'],
                'status' => $record['status'],
                'created_at' => $record['created_at'],
                'updated_at' => $record['updated_at'],
            ]);
            $counter++;
        }
    }
}