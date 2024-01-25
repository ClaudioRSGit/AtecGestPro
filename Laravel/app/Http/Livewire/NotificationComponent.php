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

    public function render()
    {
        return view('livewire.notification-component');
    }
}
