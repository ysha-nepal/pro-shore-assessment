<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-icon fs-3">
            <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar-right ms-auto">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item search-toggle-icon">
                    <a class="nav-link" href="#">
                        <div class="">
                            <i class="bi bi-search"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-user-setting">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center">
                            <img src="{{ auth()->user()->avatar }}" class="user-img" alt="">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <img src="{{ auth()->user()->avatar }}" alt="" class="rounded-circle" width="54"
                                        height="54">
                                    <div class="ms-3">
                                        <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                        <p class="mb-0 dropdown-user-designation text-secondary">{{
                                            auth()->user()->roles()->first()->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.user.profile') }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-person-fill"></i></div>
                                    <div class="ms-3"><span>{{__('core::menu.header.profile')}}</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.user.change-password') }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-alt"></i></div>
                                    <div class="ms-3"><span>Change Password</span></div>
                                </div>
                            </a>
                        </li>
                        @can('Manage Settings')
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings.edit') }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-gear-fill"></i></div>
                                    <div class="ms-3"><span>{{__('core::menu.header.setting')}}</span></div>
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('View All Logs')
                            <li>
                                <a class="dropdown-item" href="/admin/logs">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-record-circle"></i></div>
                                        <div class="ms-3"><span>{{__('core::menu.header.Logs')}}</span></div>
                                    </div>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.lang.change',[getLocaleChangerName()]) }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-translate"></i></div>
                                    <div class="ms-3"><span>{{ language_name_helper(getLocaleChangerName()) }}</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-lock-fill"></i></div>
                                    <div class="ms-3"><span>{{__('core::menu.header.logout')}}</span></div>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('website.logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @include('core::admin.layouts.partials.notifications')
            </ul>
        </div>
    </nav>
</header>
