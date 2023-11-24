<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(
            [
                'name' => 'Volodymyr',
                'email' => 'volodymyr@gmail.com',
                'email_verified_at' => now(),
                // 'password' => Hash::make('password'),
                'password' => 'password123',
                'remember_token' => Str::random(10),
            ]
        );
    }
}
