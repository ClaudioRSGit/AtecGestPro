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
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $users = User::all();

        return view('tickets.create', compact('statuses', 'priorities', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status_id' => 'required|exists:ticket_statuses,id',
            'technician_id' => 'required|exists:users,id',
            'attachment' => 'required|file',
            'priority_id' => 'required|exists:ticket_priorities,id',
            'category_id' => 'required|exists:ticket_categories,id',
            'dueByDate' => 'required|date',
        ]);
        if ($request->hasFile('attachment')) {
            $filename = $request->file('attachment')->store('attachments', 'public');
        }
        $ticket = new Ticket([
            'title' => $request->title,
            'description' => $request->description,
            'ticket_status_id' => $request->status_id,
            'ticket_priority_id' => $request->priority_id,
            'ticket_category_id' => $request->category_id,
            'dueByDate' => $request->dueByDate,
            'attachment' => $filename ?? null,
            'user_id' => $request->technician_id,
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
            'attachment' => 'sometimes|file',
            'ticket_status_id' => 'required|exists:ticket_statuses,id',
            'ticket_priority_id' => 'required|exists:ticket_priorities,id',
            'ticket_category_id' => 'required|exists:ticket_categories,id',
        ]);

        if ($request->hasFile('attachment')) {
            $filename = $request->file('attachment')->store('attachments', 'public');
            $ticket->attachment = $filename;
        }
        $ticket->update($request->except(['attachment']));

        return redirect()->route('tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
