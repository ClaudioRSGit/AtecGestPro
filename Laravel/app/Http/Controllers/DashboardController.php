<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersWithMaterialsDelivered = User::whereDoesntHave('materialUsers', function ($query) {
            $query->where('delivered_all', true);
        })->get();

        $ticketStatusOpen = DB::table('tickets')
        ->where('ticket_status_id', 1)
        ->count();

        $ticketStatusProgress = DB::table('tickets')
        ->where('ticket_status_id', 2)
        ->count();

        $ticketStatusPending = DB::table('tickets')
        ->where('ticket_status_id', 3)
        ->count();

        $ticketStatusSolved = DB::table('tickets')
        ->where('ticket_status_id', 4)
        ->count();

        $ticketStatusClosed = DB::table('tickets')
        ->where('ticket_status_id', 5)
        ->count();

        $ticketTotal = DB::table('tickets')
        ->count();

        $ticketStatusCounts = DB::table('tickets')
        ->join('ticket_priorities', 'tickets.ticket_priority_id', '=', 'ticket_priorities.id')
        ->select('ticket_priorities.description', DB::raw('count(*) as total'))
        ->groupBy('ticket_priorities.description')
        ->get();



        return view('dashboard.index', compact('usersWithMaterialsDelivered', 'ticketStatusOpen', 'ticketStatusProgress', 'ticketStatusPending', 'ticketStatusSolved', 'ticketStatusClosed', 'ticketTotal', 'ticketStatusCounts'));
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
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
