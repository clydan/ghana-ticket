<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'This is the role for the main adminstrator of the system',
                'guard_name' => 'api'
            ],
            [
                'name' => 'client',
                'display_name' => 'Client',
                'description' => 'This is a client of Gh tickets',
                'guard_name' => 'api'
            ],
        ];

        collect($roles)->each(function ($role) {
            Role::updateOrCreate(
                [
                    'name' => Arr::get($role, 'name'),
                ],
                $role
            );
        });
    }
}
