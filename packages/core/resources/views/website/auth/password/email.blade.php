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
                                <img src="images/forgot-password.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title">Forgot Password?</h5>
                                    <p class="card-text mb-5">Enter your registered email ID to reset the password</p>
                                    {{Form::open(['url' => route('password.email'),'method' =>  'POST','class' => 'form-body'])}}
                                        <div class="row g-3">
                                            @if (session('status'))
                                                <div class="mb-4 font-medium text-sm text-green-600">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="col-12">
                                                <label for="inputEmailid" class="form-label">Email id (*)</label>
                                                <input type="email" name="email" class="form-control form-control-lg radius-30 {{  ($errors->has('email') ? ' is-invalid' : "") }}" id="inputEmailid" placeholder="Email id">
                                                @include('core::admin.layouts.components.validation',['name' => 'email'])
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid gap-3">
                                                    <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                                                    <a href="{{route('login')}}" class="btn btn-lg btn-light radius-30">Back to Login</a>
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
