<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Teacher',
            'username' => 'teacher',
            'email' => 'teacher@quadralearn.com',
            'role' => \App\Enum\Role::TEACHER->value,
            'nis' => null,
        ]);
        
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'quadralearn',
            'email' => 'admin@quadralearn.com',
            'role' => \App\Enum\Role::ADMIN->value,
            'nis' => null,
        ]);

        User::factory()->create([
            'name' => 'Gibran',
            'username' => '030318077',
            'email' => '030318077@quadralearn.com',
            'role' => \App\Enum\Role::STUDENT->value,
            'nis' => '030318077',
        ]);
    }
}
