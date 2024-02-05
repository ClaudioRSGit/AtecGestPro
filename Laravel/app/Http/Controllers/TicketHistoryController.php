<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketHistory;
use Illuminate\Http\Request;

class TicketHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $ticketHistories = TicketHistory::with('ticket')->get();

        return view('ticket-histories.index', compact('ticketHistories', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketHistory  $ticketHistory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $ticket = Ticket::find($id);
        $ticketHistories = TicketHistory::where('ticket_id', $id)->get();

        return view('ticket-histories.show', compact('ticketHistories', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketHistory  $ticketHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketHistory $ticketHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketHistory  $ticketHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketHistory $ticketHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketHistory  $ticketHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketHistory $ticketHistory)
    {
        //
    }
}
