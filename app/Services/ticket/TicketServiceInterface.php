<?php

namespace App\Services\ticket;

interface TicketServiceInterface
{
    public function createTicket(array $data);
    public function getUserTickets();
    public function changeTicketStatus($ticketId, $newStatus);
}
