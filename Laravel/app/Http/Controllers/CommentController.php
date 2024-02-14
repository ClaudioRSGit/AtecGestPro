<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Notification;
use App\NotificationUser;
use App\Ticket;
use App\TicketUser;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'comment' => 'required|string',
                'ticket_id' => 'required|exists:tickets,id',
            ]);

            $ticket = Ticket::findOrFail($request->ticket_id);

            $comment = new Comment();
            $comment->description = $request->comment;
            $comment->ticket_id = $request->ticket_id;
            $comment->user_id = auth()->id();
            $comment->save();

            if ($ticket->user_id !== auth()->id()) {
                Notification::create([
                    'description' => 'O seu ticket #' . $ticket->id . ' foi comentado.',
                    'code' => 'TICKET',
                    'object_id' => $ticket->id,
                ])->users()->attach($ticket->user_id, ['isRead' => false]);
            }

            $technicianId = TicketUser::where('ticket_id', $ticket->id)->first();

            if ($technicianId && $technicianId->user_id !== auth()->id()) {
                $notificationTechnician = Notification::create([
                    'description' => 'O seu ticket #' . $ticket->id . ' foi comentado.',
                    'code' => 'TICKET_TECHNICIAN',
                    'object_id' => $ticket->id,
                ]);

                NotificationUser::create([
                    'user_id' => $technicianId->user_id,
                    'notification_id' => $notificationTechnician->id,
                    'isRead' => false,
                ]);
            }

            return redirect()->route('tickets.show', $comment->ticket_id)->with('success', 'Comentário adicionado com sucesso.');

        }
        catch (\Exception $e) {
            return back()->with('error', 'Não foi possivel adicionar o comentário');
        }

    }

}
