<?php

// app/Http/Controllers/TicketController.php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\ChangeStatusTicketRequest;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Services\ticket\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function create(CreateTicketRequest $request)
    {

        $ticket = $this->ticketService->createTicket($request->all());
        return response()->json($ticket, 201);
    }

    public function userTickets()
    {
        $tickets = $this->ticketService->getUserTickets();
        return response()->json($tickets);
    }

    public function changeStatus(ChangeStatusTicketRequest $request, $id)
    {

        $updated = $this->ticketService->changeTicketStatus($id, $request->status);

        if ($updated) {
            return response()->json(['message' => 'Ticket status updated successfully']);
        } else {
            return response()->json(['message' => 'Ticket status update failed'], 500);
        }
    }

}
