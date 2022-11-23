@extends('core::admin.layouts.default')
@section('content')
    <!-- Content Header (Page header) -->
    @include('core::admin.layouts.partials.breadcrumb')
        @include('core::admin.layouts.components.alerts')
    <!-- Main content -->
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">Change-Password</h6>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['method'=>'post','url'=>'admin/change-password/store/'. $model->id ,'enctype'=>'multipart/form-data','onsubmit'=>'showLoading()']) !!}

                            <div class="form-group row mt-2">
                               {{ Form::label('current_password','Current Password',['class' => 'col-md-4 col-form-label text-md-right']) }}
                               <div class="col-md-6">
                                   {!! Form::password('current_password',[
                                   'class'=>'form-control' . ($errors->has('current_password') ? ' is-invalid' : ""),
                                   ]) !!}
                                   @include('core::admin.layouts.components.validation',['name' => 'current_password'])
                               </div>
                            </div>
                            <div class="form-group row mt-2">
                                {{ Form::label('password','New Password',['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {!! Form::password('password',[
                                    'class'=>'form-control' . ($errors->has('password') ? ' is-invalid' : ""),
                                    ]) !!}
                                    @include('core::admin.layouts.components.validation',['name' => 'password'])
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                {{ Form::label('password_confirmation','New Password',['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation',[
                                    'class'=>'form-control' . ($errors->has('new_password_confirmation') ? ' is-invalid' : ""),
                                    ]) !!}
                                    @include('core::admin.layouts.components.validation',['name' => 'password_confirmation'])
                                </div>
                            </div>
                            <div class="form-group row mt-2 mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>


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
