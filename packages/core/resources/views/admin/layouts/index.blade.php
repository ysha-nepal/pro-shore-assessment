@extends('core::admin.layouts.default')
@section('content')
        @include('core::admin.layouts.partials.breadcrumb')
        @include('core::admin.layouts.components.alerts')
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    @include('core::admin.layouts.components.actions.create',['action' => $ui->createAction()])
                </div>
                <div class="row mt-2">
                    @includeFirst(["$package::admin.$view.search","core::admin.layouts.components.search"])
                </div>
                <div class="table-responsive mt-3">
                    @include('core::admin.layouts.components.table')
                    @include('core::admin.layouts.components.pagination')
                </div>
            </div>
        </div>
@endsection
