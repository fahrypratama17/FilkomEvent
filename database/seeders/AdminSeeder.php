<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            [
                'email' => 'admin@filkomevent2.com',
            ],
            [
                'name' => 'Administrator',
                'nim' => 'ADMIN001',
                'email' => 'admin@filkomevent2.com',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'created_at' => now(),
            ]
        );
    }
}
