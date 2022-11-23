@extends('core::admin.layouts.default')

@section('content')
    @foreach($package_widgets as $package => $widgets)
        @include("$package::admin.widgets.index",['widgets' => $widgets,'package' => $package])
    @endforeach
@endsection

