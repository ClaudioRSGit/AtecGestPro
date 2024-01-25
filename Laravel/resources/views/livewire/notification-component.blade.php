<div>
    @foreach ($notifications as $notificationUser)
        <div>
            {{ $notificationUser->notification->description }}
        </div>
    @endforeach
</div>
