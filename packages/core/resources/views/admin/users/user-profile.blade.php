@extends('core::admin.layouts.default')
@section('content')
    <!-- Content Header (Page header) -->
    @include('core::admin.layouts.partials.breadcrumb')
{{--    @include('core::admin.layouts.components.alerts')--}}
    <!-- Main content -->
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">My Account</h5>
                    <hr>

                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['method'=>'POST','url'=>route('admin.user-profile.update',$model->id) ,'enctype'=>'multipart/form-data']) !!}

                            <input type="hidden" name="redirect_url" value="{{url()->current()}}">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="name" class="form-control" value="{{$model->name}}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email address</label>
                                    <input type="text" name="email" readonly class="form-control" value="{{$model->email}}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control" value="{{$model->designation}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    {{ Form::media($model,['button' => 'Upload Profile Image','type' => 'image']) }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="{{$model->avatar}}" class="rounded-circle shadow" width="120" height="120" alt="">
                    </div>

                    <div class="text-center mt-4">
                        <h4 class="mb-1"><span class="badge bg-success">{{$model->role()->first()->name}}</span></h4>
                        <p class="mb-0 text-secondary">{{$model->designation}}</p>
                        <div class="mt-4"></div>
                        <h6 class="mb-1">{{$model->name}}</h6>
                        <p class="mb-0 text-secondary">{{$model->email}}</p>
                    </div>
                    <hr>

                </div>

            </div>
        </div>
    </div><!--end row-->
@endsection
