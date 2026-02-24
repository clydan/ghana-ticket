<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businessTypes = [
            [
                'name' => 'Retail',
                'description' => 'Businesses that sell products directly to consumers.',
            ],
            [
                'name' => 'Wholesale',
                'description' => 'Businesses that sell products in bulk to other businesses.',
            ],
            [
                'name' => 'Service',
                'description' => 'Businesses that provide services rather than physical products.',
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Businesses that produce goods from raw materials.',
            ],
            [
                'name' => 'Technology',
                'description' => 'Businesses that develop or utilize technology products or services.',
            ],
        ];

        foreach ($businessTypes as $type) {
            \App\Models\BusinessType::create($type);
        }
    }
}
