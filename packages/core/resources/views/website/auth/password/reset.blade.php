@extends('core::website.layouts.default')
@section('content')
    <div class="wrapper">
        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                                <img src="/images/forgot-password.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title">Genrate New Password</h5>
                                    <p class="card-text mb-5">We received your reset password request. Please enter your new password!</p>

                                    {{Form::open(['url'=> route('password.update'),'method' => 'POST','class'=>'form-body'])}}

                                        <input type="hidden" name="token" value="{{$token}}">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="email" class="form-label">New Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                    <input name="email" type="email" class="form-control radius-30 ps-5 {{  ($errors->has('email') ? ' is-invalid' : "") }}" id="email" value="{{$email}}">
                                                    @include('core::admin.layouts.components.validation',['name' => 'email'])
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputNewPassword" class="form-label">New Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                    <input name="password" type="password" class="form-control radius-30 ps-5 {{  ($errors->has('password') ? ' is-invalid' : "") }}" id="inputNewPassword" placeholder="Enter New Password">
                                                    @include('core::admin.layouts.components.validation',['name' => 'password'])
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                    <input name="password_confirmation" type="password" class="form-control radius-30 ps-5 {{  ($errors->has('password_confirmation') ? ' is-invalid' : "") }}" id="inputConfirmPassword" placeholder="Confirm Password">
                                                    @include('core::admin.layouts.components.validation',['name' => 'password_confirmation'])
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid gap-3">
                                                    <button type="submit" class="btn btn-primary radius-30">Change Password</button>
                                                    <a href="{{ route('login') }}" class="btn btn-light radius-30">Back to Login</a>
                                                </div>
                                            </div>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end page main-->
    </div>
@endsection()
