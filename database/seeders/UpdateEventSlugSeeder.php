<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateEventSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::whereNull('slug')->each(function ($event) {
            $event->slug = Str::slug($event->name);
            $event->save();
        });

        Client::whereNull('slug')->each(function ($client) {
            $client->slug = Str::slug($client->business_name);
            $client->save();
        });
    }
}
