<?php

namespace Database\Seeders;

use App\Models\User;
use Arr;
use Hash;
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
            ],
        ];

        collect($users)->each(function ($user) {
            $user = User::updateOrCreate(['email' => Arr::get($user, 'email')], $user);
            $client = $user->client()->create([
                'business_name' => 'Default Business',
                'address' => '123 Main Street',
                'country' => 'Ghana',
                'city' => 'Accra',
                'business_category' => 'Technology',
                'business_type' => 'Private Limited Company',
                'business_email' => 'business@email.com',
                'business_facebook_url' => 'https://facebook.com/business',
                'business_twitter_url' => 'https://twitter.com/business',
                'business_instagram_url' => 'https://instagram.com/business',
                'business_whatsapp_number' => '+233123456789',
                'business_contact' => '+233123456789',
                'tax_identification_number' => 'TIN-123456789',
                'business_description' => 'Default business description',
                'business_code' => 'MERCHANT-001',
            ]);

            $user->client_id = $client->id;
            $user->save();
        });
    }
}
