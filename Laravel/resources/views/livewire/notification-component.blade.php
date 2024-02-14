<div>
    @if($notifications->isNotEmpty())
    <a href="{{ route('notifications.readAll') }}" class="d-flex justify-content-center align-items-center">Marcar todas como lidas</a>
    @foreach ($notifications as $notificationUser)

        <div class="d-flex justify-content-between align-items-center notification-item mx-2 mb-1 {{ $notificationUser->isRead ? 'read' : 'unread' }}">
            @if($notificationUser->isRead)
            <img class="btn px-1" src="{{ asset('assets/bell.svg') }}" alt="Read Notification">
                @else
                    <img class="btn px-1" src="{{ asset('assets/bell2.svg') }}" alt="Unread Notification">
                    @endif
                    <a href="{{ route('tickets.show', $notificationUser->notification->object_id) }}" class="w-100 pl-2 pr-2"
                    wire:click.prevent="markAsRead({{ $notificationUser->id }}, {{ $notificationUser->notification->object_id }})">
                        {{ $notificationUser->notification->description }}
                    </a>
                    <button wire:click.prevent="deleteNotification({{ $notificationUser->id }})" class="delete-btn px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 384 512"><path fill="#e3342f" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg>
                    </button>
            </div>
        @endforeach
    @else
        <p class="ml-3">Não há notificações</p>
    @endif
</div>
