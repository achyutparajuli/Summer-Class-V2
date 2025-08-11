<?php

namespace Database\Seeders;

use App\Models\User;
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
        for ($i = 0; $i < 10; $i++) {
            User::updateOrCreate(
                [
                    'email' => 'user' . $i . '@gmail.com',
                ],
                [
                    'name' => 'User ' . $i,
                    'password' => Hash::make('password'),
                    'age' => $i * 2.5
                ]
            );
        }
    }
}
