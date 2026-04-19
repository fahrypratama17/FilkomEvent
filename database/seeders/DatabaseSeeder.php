<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@filkomevent.test'],
            [
                'name' => 'Admin FilkomEvent',
                'student_id' => null,
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'student@student.ub.id'],
            [
                'name' => 'Student User',
                'student_id' => '2026000001',
                'password' => 'password',
                'role' => 'student',
            ]
        );

        $sampleEvents = [
            [
                'title' => 'UI/UX Design Bootcamp',
                'description' => 'A practical bootcamp focused on user research, wireframing, and prototyping for campus products.',
                'category' => 'Design',
                'location' => 'Gedung G1, FILKOM UB',
                'starts_at' => now()->addDays(7)->setTime(9, 0),
                'ends_at' => now()->addDays(7)->setTime(15, 0),
                'quota' => 120,
                'fee' => 0,
                'status' => 'published',
                'organizer' => 'BEM FILKOM',
            ],
            [
                'title' => 'Competitive Programming Clinic',
                'description' => 'Intensive mentoring session for algorithmic thinking and contest preparation.',
                'category' => 'Programming',
                'location' => 'Laboratorium Algoritma',
                'starts_at' => now()->addDays(12)->setTime(13, 0),
                'ends_at' => now()->addDays(12)->setTime(17, 0),
                'quota' => 80,
                'fee' => 50000,
                'status' => 'published',
                'organizer' => 'Informatics Department',
            ],
            [
                'title' => 'AI and Data Science Seminar',
                'description' => 'Explore applied AI and data workflows with speakers from industry and research labs.',
                'category' => 'Seminar',
                'location' => 'Auditorium Utama FILKOM',
                'starts_at' => now()->addDays(20)->setTime(8, 30),
                'ends_at' => now()->addDays(20)->setTime(16, 0),
                'quota' => 250,
                'fee' => 150000,
                'status' => 'published',
                'organizer' => 'SGE FILKOM',
            ],
        ];

        foreach ($sampleEvents as $event) {
            Event::updateOrCreate(
                ['slug' => Str::slug($event['title'])],
                [
                    ...$event,
                    'created_by' => $admin->id,
                ]
            );
        }
    }
}
