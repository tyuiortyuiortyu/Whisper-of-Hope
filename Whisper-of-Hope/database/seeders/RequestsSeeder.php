<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HairRequest;
use App\Models\User;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'johnd@gmail.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'), // default password
            ]
        );

        $requestRecords = [
            [
                'id' => 1,
                'user_id' => $user->id,
                'who_for' => 'myself',
                'recipient_full_name' => 'John Doe',
                'recipient_age' => '71',
                'recipient_email' => 'johnd@gmail.com',
                'recipient_phone' => '08123456789',
                'recipient_reason' => 'cancer treatment',
                'status' => 'waiting',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10)
            ],
            [
                'id' => 2,
                'user_id' => $user->id,
                'who_for' => 'parent_guardian',
                'recipient_full_name' => 'Jane Doe',
                'recipient_age' => '11',
                'recipient_reason' => 'alopecia',
                'requester_full_name' => 'James Doe',
                'requester_email' => 'jamesdoe@gmail.com',
                'requester_phone' => '08123456780',
                'relationship_to_recipient' => 'father',
                'status' => 'waiting',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            [
                'id' => 3,
                'user_id' => $user->id,
                'who_for' => 'health_professional',
                'recipient_full_name' => 'Joe',
                'recipient_age' => '16',
                'recipient_email' => 'joejoe@gmail.com',
                'recipient_phone' => '08123456781',
                'recipient_reason' => 'cancer',
                'requester_full_name' => 'Dr. Smith',
                'requester_email' => 'smith@gmail.com',
                'requester_phone' => '08123456782',
                'healthcare_location' => 'somewhere out there',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
            [
                'id' => 4,
                'user_id' => $user->id,
                'who_for' => 'myself',
                'recipient_full_name' => 'Alice',
                'recipient_age' => '31',
                'recipient_email' => 'alice@gmail.com',
                'recipient_phone' => '08123456790',
                'recipient_reason' => 'autoimmune disease',
                'status' => 'waiting',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3)
            ],
            [
                'id' => 5,
                'user_id' => $user->id,
                'who_for' => 'parent_guardian',
                'recipient_full_name' => 'Ben',
                'recipient_age' => '5',
                'recipient_reason' => 'alopecia',
                'requester_full_name' => 'Bob',
                'requester_email' => 'bob@gmail.com',
                'requester_phone' => '08123456783',
                'relationship_to_recipient' => 'uncle',
                'status' => 'waiting',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7)
            ],
            [
                'id' => 6,
                'user_id' => $user->id,
                'who_for' => 'health_professional',
                'recipient_full_name' => 'Judy',
                'recipient_age' => '27',
                'recipient_email' => 'judy@gmail.com',
                'recipient_phone' => '08123456784',
                'recipient_reason' => 'systemic lupus erythematosus',
                'requester_full_name' => 'Wendy',
                'requester_email' => 'wendy@gmail.com',
                'requester_phone' => '08123456785',
                'healthcare_location' => 'a hospital nearby',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
            [
                'id' => 7,
                'user_id' => $user->id,
                'who_for' => 'myself',
                'recipient_full_name' => 'Nancy',
                'recipient_age' => '21',
                'recipient_email' => 'nancy@gmail.com',
                'recipient_phone' => '08123456786',
                'recipient_reason' => 'Polycystic Ovary Syndrome (PCOS)',
                'status' => 'waiting',
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25)
            ],
            [
                'id' => 8,
                'user_id' => $user->id,
                'who_for' => 'parent_guardian',
                'recipient_full_name' => 'Grace',
                'recipient_age' => '7',
                'recipient_reason' => 'chemotherapy',
                'requester_full_name' => 'Rachel',
                'requester_email' => 'rachel@gmail.com',
                'requester_phone' => '08123456787',
                'relationship_to_recipient' => 'grandmother',
                'status' => 'waiting',
                'created_at' => now()->subDays(51),
                'updated_at' => now()->subDays(51)
            ],
            [
                'id' => 9,
                'user_id' => $user->id,
                'who_for' => 'health_professional',
                'recipient_full_name' => 'Victor',
                'recipient_age' => '38',
                'recipient_email' => 'victor@gmail.com',
                'recipient_phone' => '08123456788',
                'recipient_reason' => 'radiation therapy',
                'requester_full_name' => 'Dr. Steve',
                'requester_email' => 'steve@gmail.com',
                'requester_phone' => '08123456789',
                'healthcare_location' => 'a clinic downtown',
                'status' => 'waiting',
                'created_at' => now()->subDays(173),
                'updated_at' => now()->subDays(173)
            ],
            [
                'id' => 10,
                'user_id' => $user->id,
                'who_for' => 'myself',
                'recipient_full_name' => 'Zoe',
                'recipient_age' => '33',
                'recipient_email' => 'zoe@gmail.com',
                'recipient_phone' => '08123456791',
                'recipient_reason' => 'Trichotillomania',
                'status' => 'waiting',
                'created_at' => now()->subDays(78),
                'updated_at' => now()->subDays(78)
            ],
            [
                'id' => 11,
                'user_id' => $user->id,
                'who_for' => 'parent_guardian',
                'recipient_full_name' => 'Hannah',
                'recipient_age' => '16',
                'recipient_reason' => 'hyperthyroidism',
                'requester_full_name' => 'Laura',
                'requester_email' => 'laura@gmail.com',
                'requester_phone' => '08123456780',
                'relationship_to_recipient' => 'sister',
                'status' => 'waiting',
                'created_at' => now()->subDays(256),
                'updated_at' => now()->subDays(256)
            ],
            [
                'id' => 12,
                'user_id' => $user->id,
                'who_for' => 'health_professional',
                'recipient_full_name' => 'Chris',
                'recipient_age' => '18',
                'recipient_email' => 'chris@gmail.com',
                'recipient_phone' => '08123456781',
                'recipient_reason' => 'Discoid Lupus Erythematosus',
                'requester_full_name' => 'Dr. Sarah',
                'requester_email' => 'sarah@gmail.com',
                'requester_phone' => '08123456782',
                'healthcare_location' => 'a medical center in the city',
                'status' => 'waiting',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21)
            ],
        ];

        foreach ($requestRecords as $record) {
            HairRequest::insert($record);
        }
    }
}
