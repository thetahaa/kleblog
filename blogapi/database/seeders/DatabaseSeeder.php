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
    public function run()
    {
        
        $this->call([
            ShieldSeeder::class,
            PolicesSeeder::class
        ]);        

        // User::factory()->create([
        //     'name' => 'Taha',
        //     'email' => 'taha@gmail.com',
        //     'password' => ('taha12345')
        // ])->assignRole('super_admin');
         User::create([
            'name' => 'Taha', 
            'email' => 'taha123@gmail.com',
            'password' => password_hash('taha1234', PASSWORD_DEFAULT),
        ])->assignRole('super_admin');
    }
}
