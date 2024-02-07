<div>
    @if($notifications->isNotEmpty())
    <a href="{{ route('notifications.readAll') }}" class="d-flex justify-content-center">Marcar todas como lidas</a>
    @foreach ($notifications as $notificationUser)

        <div class="notification-item mx-2">
            @if($notificationUser->isRead)
            <img src="{{ asset('assets/bell.svg') }}" alt="Read Notification">
                @else
                    <img src="{{ asset('assets/bell2.svg') }}" alt="Unread Notification">
                @endif
                <a href="{{ route('tickets.show', $notificationUser->notification->object_id) }}" class="{{ $notificationUser->isRead ? 'read' : 'unread' }}"
                   wire:click.prevent="markAsRead({{ $notificationUser->id }}, {{ $notificationUser->notification->object_id }})">
                    {{ $notificationUser->notification->description }}
                </a>
                <button wire:click.prevent="deleteNotification({{ $notificationUser->id }})" class="delete-btn">X</button>
            </div>
        @endforeach
    @else
        <p class="ml-3">Não há notificações</p>
    @endif
</div>
