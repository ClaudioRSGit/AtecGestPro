<?php

namespace App\Jobs;

use App\Mail\TicketEmail;
use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticketId;

    /**
     * Create a new job instance.
     *
     * @param  int  $ticketId
     * @return void
     */
    public function __construct(int $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $ticket = Ticket::with('requester')->find($this->ticketId);

        $email = new TicketEmail($ticket);


        Mail::to($ticket->requester->email)->send($email);
    }

    public function failed(Exception $exception)
    {
        Log::error("Job has failed due to: {$exception->getMessage()}");
    }
}
