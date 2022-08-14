<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge" id = "newNotifications">{{ $new }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id ="notificationsList">
        <span class="dropdown-header"> Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <div class="dropdown-divider"></div>
            <a href="{{ $notification->data['url'] }}?notify_id = {{$notification->id}}" class="dropdown-item">
                @if ($notification->unread())
                    <strong>*</strong>
                @endif
                <i class="fas fa-envelope mr-2"></i> {{ $notification->data['body'] }}
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
        @endforeach
    </div>
