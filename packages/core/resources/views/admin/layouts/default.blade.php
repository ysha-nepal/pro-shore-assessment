<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('core::admin.layouts.partials.head')

<body data-user-id="{{ auth()->id() }}" data-chat-connection="{{ setting_helper('chat-settings','status') }}">
    <div class="wrapper">
        @include('core::admin.layouts.partials.header')
        @include('core::admin.layouts.partials.sidebar')
        <main class="page-content">
            @yield('content')
        </main>
        @include('core::admin.layouts.partials.footer')
    </div>
</body>
</html>
