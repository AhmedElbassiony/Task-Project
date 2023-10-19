<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'ahmed',
            'last_name' => 'mohamed',
            'email' => 'admin@email.com',
            'mobile' => '01234567890',
            'password' => bcrypt('password'),
            'verified' => true,
        ])->assignRole('admin');

    }
}
