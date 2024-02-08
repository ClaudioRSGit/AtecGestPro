<?php

namespace App\Http\Controllers;

use App\Mail\TicketEmail;
use App\Ticket;
use App\TicketHistory;
use App\User;
use App\TicketStatus;
use App\TicketPriority;
use App\TicketCategory;
use App\TicketUser;
use App\Action;
use App\Notification;
use App\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $filterCategory = $request->input('filterCategory');
        $filterPriority = $request->input('filterPriority');
        $filterStatus = $request->input('filterStatus');
        $ticketSearch = $request->input('ticketSearch');

        $sort = $request->query('sort');
        $direction = $request->query('direction', 'asc');
        $query = Ticket::query();

        switch ($sort) {
            case 'number':
                $sortColumn = 'id';
                break;
            case 'title':
                $sortColumn = 'title';
                break;
            case 'user':
                $sortColumn = 'user_id';
                break;
            default:
                $sortColumn = 'id';
        }




        if (auth()->user()->role_id == 2) {
            $query = Ticket::where('user_id', auth()->id());
            $waitingQueueTickets = Ticket::where('user_id', auth()->id())->paginate(5);
            $recycledTickets = Ticket::onlyTrashed()->where('user_id', auth()->id())->paginate(5);
        } else {
            $query = Ticket::with('users','requester');
            $waitingQueueTickets = Ticket::whereHas('users', function ($query) {
                $query->where('role_id', 4)
                      ->where('name', 'Fila de Espera');
                    })->paginate(5);
            $recycledTickets = Ticket::onlyTrashed()->paginate(5);
        }

        if ($ticketSearch) {
            $query->where(function ($query) use ($ticketSearch) {
                $query->where('title', 'like', '%' . $ticketSearch . '%')
                    ->orWhereHas('requester', function ($query) use ($ticketSearch) {
                        $query->where('name', 'like', '%' . $ticketSearch . '%');
                    });
            });
        }

        if ($filterCategory) {
            $query->where('ticket_category_id', $filterCategory);
        }
        if ($filterPriority) {
            $query->where('ticket_priority_id', $filterPriority);
        }
        if ($filterStatus) {
            $query->where('ticket_status_id', $filterStatus);
        }


        $query->orderBy($sortColumn ,  $direction);

        $tickets = $query->paginate(5);
        $users = User::all();
        $categories = TicketCategory::all();
        $priorities = TicketPriority::all();
        $statuses = TicketStatus::all();

        return view('tickets.index', compact('tickets', 'users', 'ticketSearch', 'filterCategory', 'filterPriority', 'filterStatus', 'categories', 'priorities', 'statuses', 'waitingQueueTickets', 'recycledTickets', 'sort', 'direction'));
    }

    public function create()
    {

        $statuses = TicketStatus::where('id', 1)->get();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $technicians = User::where('name', 'Fila de Espera')->get();

        return view('tickets.create', compact('statuses', 'priorities', 'categories', 'technicians'));
    }
    public function calculateDueByDate($priorityId)
    {
        switch ($priorityId) {
            case 1: // Baixa
                return now()->addWeeks(3);
            case 2: // Normal
                return now()->addWeeks(2);
            case 3: // Alta
                return now()->addWeeks(1);
            case 4: // Urgente
                return now()->addDay();
            case 5: // Crítico
                return now()->addHours(4);
            default:

                return now()->addWeeks(3);
        }
    }
    public function store(TicketRequest $request)
    {
        try {
            $loggedInUserId = Auth::id();
            $dueByDate = $this->calculateDueByDate($request->priority_id);
            $filename = 'Sem Anexo';
            if ($request->hasFile('attachment')) {
                $filename = $request->file('attachment')->store('attachments', 'public');
            }
            $ticket = new Ticket([
                'title' => $request->title,
                'description' => $request->description,
                'ticket_status_id' => 1,
                'ticket_priority_id' => $request->priority_id,
                'ticket_category_id' => $request->category_id,
                'dueByDate' => $dueByDate,
                'user_id' => $loggedInUserId,
                'attachment' => $filename,
            ]);

            $ticket->save();

            TicketUser::create([
                'ticket_id' => $ticket->id,
                'user_id' => $request->technician_id,
            ]);

            $ticketInfo = 'Ticket #' . $ticket->id . ' foi criado por ' . User::find($loggedInUserId)->name . '.';

            $this->logTicketHistory($ticket->id, 1, $ticketInfo);
            $this->sendEmail($ticket->id);
            return redirect()->route('tickets.index')->with('success', 'Ticket criado com sucesso!')->with('active_tab', 'allTickets');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o ticket. Por favor, tente novamente.');
        }
    }

    public function show(Ticket $ticket)
    {
        $ticket = Ticket::with(['users', 'requester', 'comments' => function($query) {
            $query->orderBy('created_at', 'desc');
        }, 'comments.user'])->find($ticket->id);

        $id = $ticket->id;
        $ticketHistories = TicketHistory::where('ticket_id', $id)->get();

        $users = User::all();
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $userTickets = Ticket::where('user_id', $ticket->user_id)->pluck('id');
        $ticketTechnician = TicketUser::where('ticket_id', $ticket->id)->first('user_id');
        $technician = User::where('id', $ticketTechnician->user_id)->first();
        $requester = User::where('id', $ticket->user_id)->first();

        return view('tickets.show', compact('ticket', 'userTickets', 'users', 'statuses', 'priorities', 'categories', 'technician', 'requester', 'ticketHistories'));
    }

    public function edit(Ticket $ticket)
    {
        $ticket = Ticket::with('users','requester')->find($ticket->id);
        $technicians = User::where('role_id', 4)->get();
        $requester = User::where('id', $ticket->user_id)->first();
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        $userTickets = Ticket::where('user_id', $ticket->user_id)->pluck('id');
        $ticketTechnician = TicketUser::where('ticket_id', $ticket->id)->first('user_id');

        return view('tickets.edit', compact('ticket', 'technicians',  'requester', 'statuses', 'priorities', 'categories', 'userTickets', 'ticketTechnician'));
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {
            $oldTicket = clone $ticket;
            $oldTicketTechnician = clone TicketUser::where('ticket_id', $ticket->id)->first('user_id');
            $newUserId = $request->technician_id;
            $ticketId = $ticket->id;

            if ($ticket->ticket_priority_id != $request->ticket_priority_id) {
                $dueByDate = $this->calculateDueByDate($request->ticket_priority_id);
            } else {
                $dueByDate = $ticket->dueByDate;
            }

            $request->merge(['dueByDate' => $dueByDate]);

            if ($request->hasFile('attachment')) {
                $filename = $request->file('attachment')->store('attachments', 'public');
                $ticket->attachment = $filename;
            }

            $ticket->title = $request->title;
            $ticket->description = $request->description;
            $ticket->dueByDate = $request->dueByDate;
            $ticket->ticket_priority_id = $request->ticket_priority_id;
            $ticket->ticket_status_id = $request->ticket_status_id;
            $ticket->ticket_category_id = $request->ticket_category_id;

            $ticket->save();

            TicketUser::where('ticket_id', $ticketId)->update([
                'user_id' => $newUserId,
            ]);

            $ticketInfo = $this->generateTicketInfo($oldTicket, $ticket, $oldTicketTechnician->user_id, $newUserId);

            if (!empty($ticketInfo)) {
                $this->logTicketHistory($ticket->id, 2, $ticketInfo);
            }

            $notification = Notification::create([
                'description' => 'Ticket atribuido: #' . $ticket->id,
                'code' => 'TICKET',
                'object_id' => $ticket->id,
            ]);

            NotificationUser::create([
                'user_id' => $request->technician_id,
                'notification_id' => $notification->id,
                'isRead' => false,
            ]);
            return redirect()->route('tickets.index')->with('success', 'Ticket atualizado com sucesso!')->with('active_tab', 'allTickets');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Não foi possivel atualizar o ticket. Por favor, tente novamente.');
        }
    }
    public function destroy(Ticket $ticket)
    {
        try {
            $ticket->delete();

            $this->logTicketHistory($ticket->id, 3, 'O ticket #' . $ticket->id . ' foi removido por ' . User::find(Auth::id())->name . '.');

            return redirect()->route('tickets.index')->with('success', 'Ticket removido com sucesso!')->with('active_tab', 'allTickets');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover o ticket. Por favor, tente novamente.');
        }
    }

    public function showComment($id)
    {
        $ticket = Ticket::with(['comments' => function($query) {
            $query->orderBy('created_at', 'desc');
        },
        'comments.user'])->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    protected function logTicketHistory($ticketId, $actionId,  $ticketInfo)
    {
        TicketHistory::create([
            'ticket_id' => $ticketId,
            'action_id' => $actionId,
            'ticket_info' => $ticketInfo,
        ]);
    }

    public function generateTicketInfo($oldTicket, $ticket, $oldUserId, $newUserId)
    {
        $ticketInfo = '';

        if ($oldTicket->ticket_status_id != $ticket->ticket_status_id) {
            $oldStatusName = TicketStatus::find($oldTicket->ticket_status_id)->description;
            $newStatusName = TicketStatus::find($ticket->ticket_status_id)->description;
            $ticketInfo .= 'O estado do ticket #' . $ticket->id . ' foi atualizado de ' . $oldStatusName . ' para ' . $newStatusName . ' por ' . User::find(Auth::id())->name . ".\n";
        }

        if ($oldTicket->ticket_priority_id != $ticket->ticket_priority_id) {
            $oldPriorityName = TicketPriority::find($oldTicket->ticket_priority_id)->description;
            $newPriorityName = TicketPriority::find($ticket->ticket_priority_id)->description;
            $ticketInfo .= 'A prioridade do ticket #' . $ticket->id . ' foi atualizada de ' . $oldPriorityName . ' para ' . $newPriorityName . ' por ' . User::find(Auth::id())->name . ".\n";
        }

        if ($oldTicket->ticket_category_id != $ticket->ticket_category_id) {
            $oldCategoryName = TicketCategory::find($oldTicket->ticket_category_id)->name;
            $newCategoryName = TicketCategory::find($ticket->ticket_category_id)->name;
            $ticketInfo .= 'A categoria do ticket #' . $ticket->id . ' foi atualizada de ' . $oldCategoryName . ' para ' . $newCategoryName . ' por ' . User::find(Auth::id())->name . ".\n";
        }

        if ($oldTicket->dueByDate != $ticket->dueByDate) {
            $ticketInfo .= 'A data de vencimento do ticket #' . $ticket->id . ' foi atualizada de ' . $oldTicket->dueByDate . ' para ' . $ticket->dueByDate . ' por ' . User::find(Auth::id())->name . ".\n"; ;
        }

        if ($oldUserId != $newUserId) {
            $oldTechnicianName = User::find($oldUserId)->name;
            $newTechnicianName = User::find($newUserId)->name;
            $ticketInfo .= 'O técnico assignado ao ticket #' . $ticket->id . ' foi alterado de ' . $oldTechnicianName . ' para ' . $newTechnicianName . ' por ' . User::find(Auth::id())->name . ".\n";
        }

        if ($oldTicket->title != $ticket->title) {
            $ticketInfo .= 'O titulo do ticket #' . $ticket->id . ' foi alterado de ' . $oldTicket->title . ' para ' . $ticket->title . ' por ' . User::find(Auth::id())->name . ".\n";
        }

        return $ticketInfo;
    }

    public function restore($id)
    {
        $ticket = Ticket::onlyTrashed()->findOrFail($id);
        $ticket->restore();

        $this->logTicketHistory($ticket->id, 4, 'O ticket #' . $ticket->id . ' foi restaurado por ' . User::find(Auth::id())->name . '.');

        return redirect()->route('tickets.index')->with('success', 'Restaurado com sucesso!')->with('active_tab', 'allTickets');
    }

    public function forceDelete($id)
    {
        try {
            $ticket = Ticket::onlyTrashed()->findOrFail($id);
            $ticket->forceDelete();

            return redirect()->route('tickets.index')->with('success', 'Ticket apagado permanentemente!')->with('active_tab', 'allTickets');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao apagar o ticket. Por favor, tente novamente.');
        }
    }

    public function sendEmail($id)
    {
// // dd($id);
//         $ticket = Ticket::with('requester')->find($id);
// //        dd($ticket->requester->email);

//         $email = new TicketEmail($ticket);
// //        dd($email);
//         Mail::to($ticket->requester->email)->send($email);
//         return view('tickets.show', compact('ticket'));
    }

    public function storeQuickTicket(Request $request){
        try {
            $loggedInUserId = Auth::id();
            $dueByDate = $this->calculateDueByDate($request->priority_id);
            $filename = 'Sem Anexo';
            if ($request->hasFile('attachment')) {
                $filename = $request->file('attachment')->store('attachments', 'public');
            }
            $ticket = new Ticket([
                'title' => $request->title,
                'description' => $request->description,
                'ticket_status_id' => 1,
                'ticket_priority_id' => $request->priority_id,
                'ticket_category_id' => $request->category_id,
                'user_id' => $loggedInUserId,
                'dueByDate' => $dueByDate,
                'attachment' => $filename,
            ]);

            $ticket->save();

            TicketUser::create([
                'ticket_id' => $ticket->id,
                'user_id' => $loggedInUserId,
            ]);

            $ticketInfo = 'Ticket #' . $ticket->id . ' foi criado por ' . User::find($loggedInUserId)->name . '.';

            $this->logTicketHistory($ticket->id, 1, $ticketInfo);
            $this->sendEmail($ticket->id);

            return redirect()->route('tickets.index')->with('success', 'Ticket criado com sucesso!')->with('active_tab', 'allTickets');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o ticket. Por favor, tente novamente.');
        }
    }

}
