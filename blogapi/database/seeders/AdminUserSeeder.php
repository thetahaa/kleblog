<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Taha', 
        //     'email' => 'taha@gmail.com',
        //     'password' => password_hash('taha1234', PASSWORD_DEFAULT),
        // ])->assignRole('super_admin');
    }
}
