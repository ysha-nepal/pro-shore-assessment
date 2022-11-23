<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{__($package.'::menu.sidebar.'.$title)}}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                @if(isset($breadcrumbs))
                    @foreach($breadcrumbs as $name => $route)
                        @if(!$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $route }}">{{__($package.'::breadcrumbs.'.$name)}}</a> </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{__($package.'::breadcrumbs.'.$name)}}</li>
                        @endif
                    @endforeach
                @else
{{--                    <li class="breadcrumb-item"><a href="{{ route((isset($ui) ? " $ui->prefix" : 'admin') .".dashboard")}}"><i class="bi bi-house-door"></i></a> </li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page">{{__($package.'::breadcrumbs.'.$title)}}</li>--}}
                @endif
            </ol>
        </nav>
    </div>
</div>
