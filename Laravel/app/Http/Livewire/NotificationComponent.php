<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\NotificationUser;

class NotificationComponent extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = NotificationUser::where('user_id', auth()->id())
            ->with('notification')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead($notificationUserId, $ticketId)
    {
        $notificationUser = NotificationUser::findOrFail($notificationUserId);
        $notificationUser->isRead = true;
        $notificationUser->save();

        $this->emit('redirectToTicket', $ticketId);
    }

    protected $listeners = [
        'redirectToTicket' => 'redirectToTicket',
    ];

    public function redirectToTicket($ticketId)
    {
        return redirect()->to('/tickets/' . $ticketId);
    }

    public function render()
    {
        return view('livewire.notification-component');
    }

    public function deleteNotification($notificationUserId)
    {
        $notificationUser = NotificationUser::findOrFail($notificationUserId);
        $notificationUser->isRead = true;
        $notificationUser->delete();

        $this->mount();
        return redirect(request()->header('Referer'));
    }
}
