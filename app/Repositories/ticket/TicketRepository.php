<?php

namespace App\Repositories\ticket;

use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function createTicket(array $data)
    {
        return Ticket::create($data);
    }

    public function find($id)
    {
        return Ticket::find($id);
    }

    public function getUserTickets($userId)
    {
        return Ticket::where('user_id', $userId)->get();
    }

    public function updateTicketStatus(Ticket $ticket, $newStatus)
    {
        $ticket->update(['status' => $newStatus]);

        if ($newStatus === 'completed') {
            $ticket->update(['status' => 'close']);
        }
    }
}
