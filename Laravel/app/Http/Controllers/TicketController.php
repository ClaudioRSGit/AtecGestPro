<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use App\TicketStatus;
use App\TicketPriority;
use App\TicketCategory;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('users','requester')->get();
        $users = User::all();
        return view('tickets.index', compact('tickets', 'users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $ticket = new Ticket([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status,
            'technician_id' => $request->technician,
            'priority_id' => $request->priority,
            'category_id' => $request->category,
            'due_by_date' => $request->dueByDate,
            ]);

        $ticket->save();

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        $ticket = Ticket::with('users','requester')->find($ticket->id);
        $users = User::all();
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $userTickets = Ticket::where('user_id', $ticket->user_id)->pluck('id');

        return view('tickets.show', compact('ticket', 'userTickets', 'users', 'statuses', 'priorities', 'categories'));
    }

    public function edit(Ticket $ticket)
    {
        $ticket = Ticket::with('users','requester')->find($ticket->id);
        $users = User::all();
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $userTickets = Ticket::where('user_id', $ticket->user_id)->pluck('id');

        return view('tickets.edit', compact('ticket', 'users', 'statuses', 'priorities', 'categories', 'userTickets'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'dueByDate' => 'required|date',
            'ticket_status_id' => 'required|exists:ticket_statuses,id',
            'ticket_priority_id' => 'required|exists:ticket_priorities,id',
            'ticket_category_id' => 'required|exists:ticket_categories,id',
        ]);

        $ticket->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'due_by_date' => $validatedData['dueByDate'],
            'ticket_status_id' => $validatedData['ticket_status_id'],
            'ticket_priority_id' => $validatedData['ticket_priority_id'],
            'ticket_category_id' => $validatedData['ticket_category_id'],
        ]);

        return redirect()->route('tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
