<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@filkomevent.test',
        ], [
            'name' => 'Admin FilkomEvent',
            'nim' => '0000000000000001',
            'password' => 'password',
            'role' => 'Admin',
        ]);

        User::query()->updateOrCreate([
            'email' => 'student@student.ub.ac.id',
        ], [
            'name' => 'Mahasiswa FilkomEvent',
            'nim' => '0000000000000002',
            'password' => 'password',
            'role' => 'Mahasiswa',
        ]);
    }
}
