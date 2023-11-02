<?php

namespace App\Services\ticket;

use App\Repositories\ticket\TicketRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class TicketService implements TicketServiceInterface
{
    protected $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function createTicket(array $data)
    {
        if (!Auth::user()->hasRole('admin')){
            throw new AuthorizationException();
        }
        $data['user_id']=Auth::id();
            return $this->ticketRepository->createTicket($data);

        return null;
    }

    public function getUserTickets()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            return $this->ticketRepository->getUserTickets($userId);
        }

        return null;
    }

    public function changeTicketStatus($ticketId, $newStatus)
    {
        if (!Auth::user()->hasRole('admin')){
            throw new AuthorizationException();
        }
            $ticket = $this->ticketRepository->find($ticketId);

            if ($ticket) {
                $this->ticketRepository->updateTicketStatus($ticket, $newStatus);
                return true;
            }
        return false;
    }
}
