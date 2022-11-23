@extends('core::website.layouts.default')

@section('content')
    <main class="authentication-content">
        <div class="container">
            <div class="mt-4">
                <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
                    <div class="row g-0">
                        <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                            <img src="images/login-img.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-12 col-xl-4 order-xl-2">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Sign In</h5>
                                <p class="card-text mb-4">See your growth and get consulting support!</p>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                {{Form::open(['url' => route('login'),'method' => 'POST','class' =>'form-body'])}}
                                <div class="row g-3">
                                    <div class="col-12">
                                        {{Form::label('email','Email (*)')}}
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                            {{Form::text('username',null,[
                                                   'class'=>'form-control radius-30 ps-5' . ($errors->has('username') ? ' is-invalid' : ""),
                                                  'placeholder' => 'Username'
                                            ])}}
                                            @include('core::admin.layouts.components.validation',['name' => 'username'])
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        {{Form::label('password','Password (*)')}}
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                            {{Form::password('password',[
                                                'class'=>'form-control radius-30 ps-5' . ($errors->has('password') ? ' is-invalid' : ""),
                                                'placeholder' => 'Password'
                                            ])}}
                                            @include('core::admin.layouts.components.validation',['name' => 'password'])
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">	<a href="{{route('password.request')}}">Forgot Password ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary radius-30">Sign In</button>
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
@endsection()
