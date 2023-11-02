<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            // Define the attributes you want to set for a Ticket instance
            'user_id' => \App\Models\User::factory(),
            'service_id' => \App\Models\Service::factory(),
            'status' => 'pending', // Set an initial status
            // Add other attributes here
        ];
    }
}
