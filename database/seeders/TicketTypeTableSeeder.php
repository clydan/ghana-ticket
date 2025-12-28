<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                'name' => 'General Admission',
                'description' => 'Access to the general area of the event.',
                'is_pricable' => true,
            ],
            [
                'name' => 'VIP',
                'description' => 'Access to VIP areas with additional perks.',
                'is_pricable' => true,
            ],
            [
                'name' => 'Backstage Pass',
                'description' => 'Access to backstage areas and meet-and-greet opportunities.',
                'is_pricable' => true,
            ],
            [
                'name' => 'Complimentary',
                'description' => 'Free access provided by the event organizer.',
                'is_pricable' => false,
            ],
            [
                'name' => 'Early Bird',
                'description' => 'Discounted tickets for early purchasers.',
                'is_pricable' => true,
            ],
            [
                'name' => 'Donation',
                'description' => 'Tickets purchased as a donation to support the event or cause.',
                'is_pricable' => true,
            ],
            [
                'name' => 'Concession',
                'description' => 'Discounted tickets for students, seniors, or military personnel.',
                'is_pricable' => true,
            ],
            [
                'name' => 'Reserved Seating',
                'description' => 'Tickets for specific seats at the event.',
                'is_pricable' => true,
            ],
        ];

        collect($tickets)->each(function ($ticket) {
            TicketType::firstOrCreate(['name' => $ticket['name']], $ticket);
        });
    }
}
