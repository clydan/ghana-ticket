<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountTypes = [
            [
                'name' => 'Individual',
                'description' => 'An account for individual users who want to purchase tickets for events.',
            ],
            [
                'name' => 'Business',
                'description' => 'An account for businesses that want to organize events and sell tickets.',
            ],
            [
                'name' => 'Non-Profit',
                'description' => 'An account for non-profit organizations that want to organize events and sell tickets.',
            ],
        ];

        foreach ($accountTypes as $type) {
            \App\Models\AccountType::create($type);
        }
    }
}
