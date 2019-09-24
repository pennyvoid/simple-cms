<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'ali kazemi',
            'email' => 'alikazemi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

    }
}
