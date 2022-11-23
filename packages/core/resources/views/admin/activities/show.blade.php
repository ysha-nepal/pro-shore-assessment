@extends('core::admin.layouts.default')
@section('content')
    @include('core::admin.layouts.partials.breadcrumb')
    @include('core::admin.layouts.components.alerts')
    <div class="row">
        <div class="col-md-12" id="listing">
            <div class="card card-default">
                <div class="card-header with-border">
                    <h3 class="card-title">{{ $model->event }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Event : </strong> {{ $model->event }}</li>
                        <li class="list-group-item"><strong>Description : </strong> {{ $model->description }}
                        </li>
                        <li class="list-group-item"><strong>Created : </strong>{{
                                    $model->created_at->diffForHumans() }}</li>
                        @foreach($model->properties as $key => $property)
                            <li class="list-group-item"><strong>{{ ucwords($key) . " : " }} </strong>{{ $property }}
                            </li>
                        @endforeach
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
