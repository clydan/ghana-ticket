<?php

namespace Database\Seeders;

use App\Models\User;
use Arr;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Auth User',
                'email' => 'e@mail.com',
                'password' => Hash::make('password'),
            ]
        ];

        collect($users)->each(function($user){
            User::updateOrCreate(['email' => Arr::get($user, 'email')], $user);
        });
    }
}
