@extends('core::admin.layouts.default')
@section('content')
@include('core::admin.layouts.partials.breadcrumb')
@include('core::admin.layouts.components.alerts')
<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <ul class="nav nav-tabs">
                @foreach($settings as $setting)
                @can($setting->permission)
                <li class="nav-item">
                    <a class="nav-link {{ $setting->name === $model->name ? 'active' : null }}"
                        href="{{ route('admin.settings.edit',['name' => $setting->name]) }}">
                        {{ __($package.'::setting.common.'.$setting->display_name) }}
                    </a>
                </li>
                @endcan
                @endforeach
            </ul>
            <div class="mt-2">
                {{ Form::model($model,['url' => route('admin.settings.update',['name' => $model->name]),'method' =>
                'PUT']) }}
                @include("$model->package::admin.settings.partials." . $model->name)
                <button type="submit" class="btn btn-outline-primary">{{__('core::admin.buttons.save')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
