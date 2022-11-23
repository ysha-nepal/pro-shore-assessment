<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($title) ? setting_helper('general-setting','name') . " | " . $title : setting_helper('general-setting','name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="/css/website/app.min.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
    </head>
    <body CLASS="bg-surface">
        <div class="wrapper">
            @include('core::website.layouts.partials.header')
            @yield('content')
            @include('core::website.layouts.partials.footer')
        </div>
       <script src="/js/website/app.min.js"></script>
    </body>
</html>
