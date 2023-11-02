<?php

namespace App\Repositories\ticket;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function createTicket(array $data);
    public function getUserTickets($userId);
    public function updateTicketStatus(Ticket $ticket, $newStatus);
    public function find($id);
}
