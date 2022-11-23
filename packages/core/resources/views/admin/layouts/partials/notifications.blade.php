<li class="nav-item dropdown dropdown-large notifications-dropdowns" data-url="{{ route('api.notifications.list.index') }}">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
        <div class="notifications">
            <span class="notify-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            <i class="bi bi-bell-fill"></i>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end p-0">
        <div class="p-2 border-bottom m-2">
            <h5 class="h5 mb-0">{{__('core::menu.header.notification')}}</h5>
        </div>
        <div class="header-notifications-list p-2">

        </div>
        <div class="p-2">
            <div><hr class="dropdown-divider"></div>
            <a class="dropdown-item notifications-read" href="{{ route('api.notifications.list.read') }}">
                <div class="text-center">Mark As Read</div>
            </a>
        </div>
    </div>

</li>
