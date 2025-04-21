<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'name' => "Teszt $i",
                'email' => "teszt$i@teszt.com",
                'password' => Hash::make('123456789'),
                'is_admin' => false,
            ]);
        }

        User::create([
            'name' => 'admin',
            'email' => 'admin@teszt.com',
            'password' => Hash::make('123456789'),
            'is_admin' => 1,
        ]);
    }
}