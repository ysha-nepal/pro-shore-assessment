@foreach($notifications as $notification)
    <a class="dropdown-item" href="{{ $notification->data['route'] ?? '#' }}">
        <div class="d-flex align-items-center">
            <div class="ms-3 flex-grow-1">
                <h6 class="mb-0 dropdown-msg-user">{{ $notification->data['title'] ?? '' }}  <span class="msg-time float-end text-secondary">{{$notification->created_at->diffForHumans()}}</span></h6>
                <p class="mb-0 dropdown-msg-text text-secondary text-wrap">{{ $notification->data['message'] ?? '' }}</p>
            </div>
        </div>
    </a>
@endforeach
