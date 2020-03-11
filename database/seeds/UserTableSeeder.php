<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'huda@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Muhamad Nur Huda',
                'email' => 'huda@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('12345678')
            ]);
        }
    }
}
