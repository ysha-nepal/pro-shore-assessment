<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{media_helper(setting_helper('general-settings','logo'))}}" class="logo-icon"
                alt="{{ setting_helper('general-settings','name') }}">
        </div>
        <div>
            <h6 class="logo-text">{{ setting_helper('general-settings','name') }}</h6>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @foreach($menus as $parent_menu)
        <li>
            @if($parent_menu->children->count() > 0)
                @if(Auth::user()->hasAnyPermission($parent_menu->children->pluck('permission','permission')))
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="{{$parent_menu->icon}}"></i>
                        </div>
                        <div class="menu-title">{{__($parent_menu->package .'::menu.sidebar.'.$parent_menu->display_name)}}</div>
                    </a>
                @endif
            <ul>
                @foreach($parent_menu->children->where('status',1)->sortBy('order') as $child_menu)
                <li>
                    @can($child_menu->permission)
                        <a href="{{ route($child_menu->route) }}"><i
                                class="{{ $child_menu->icon }}"></i>{{__($child_menu->package.'::menu.sidebar.'.
                        $child_menu->display_name) }}</a>
                    @endcan
                </li>
                @endforeach
            </ul>
            @else
                @can($parent_menu->permission)
                    <a href="{{ route($parent_menu->route) }}">
                        <div class="parent-icon"><i class="{{$parent_menu->icon}}"></i>
                        </div>
                        <div class="menu-title">{{__($parent_menu->package.'::menu.sidebar.'.$parent_menu->display_name)}}</div>
                    </a>
                @endcan
            @endif
        </li>
        @endforeach
    </ul>
    <!--end navigation-->
</aside>
