<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;

class RequestStatusNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function testStatusChange()
    {
        $user = User::factory()->create();

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $ticket->update(['status' => 'completed']);

        $this->assertEquals('completed', $ticket->fresh()->status);
    }
}
