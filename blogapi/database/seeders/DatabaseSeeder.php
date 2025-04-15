<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        
        $this->call([
            ShieldSeeder::class,
            PolicesSeeder::class
        ]);        

         User::create([
            'name' => 'Taha', 
            'email' => 'taha@gmail.com',
            'password' => password_hash('taha1234', PASSWORD_DEFAULT),
        ])->assignRole('super_admin');
    }
}
