@extends('core::admin.layouts.default')
@section('content')
@include('core::admin.layouts.partials.breadcrumb')
@include('core::admin.layouts.components.alerts')
<div class="row">
    <div class="col col-lg-12 mx-auto">
        <div class="card">
            <div class="card-body">
                @if($model->translatable)
                    <ul class="nav nav-tabs nav-primary mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#lang_english" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">English</div>
                                </div>
                            </a>
                        </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#lang_nepali" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Nepali</div>
                                    </div>
                                </a>
                            </li>
                    </ul>
                @endif
                {{ Form::model($model, ['url' => $ui->getRoute($model,$params), 'method' => $ui->getMethod($model,$params),'files' => true]) }}
                <div class="tab-content py-3">
                    <div class="tab-pane fade active show" id="lang_english" role="tabpanel">
                        <div class="row g-3">
                            @include($form)
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lang_nepali" role="tabpanel">
                        @yield('nepali_fields')
                    </div>
                </div>

                <button type="submit" name="submit" value="SUBMIT"
                        class="btn btn-outline-primary px-5 rounded-0">{{__($package.'::admin.buttons.' . $ui->saveBtn)}}</button>
                @if($ui->addanother && !$model->exists)
                    <button type="submit" name="submit" value="RSUBMIT"
                            class="btn btn-outline-primary px-5 rounded-0">{{__($package.'::admin.buttons.Save And Add Another')}}</button>
                @endif
                <a type="button" class="btn btn-outline-danger px-5 rounded-0"
                   href="{{ url()->previous() }}">{{__($package.'::admin.buttons.Cancel')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
@endsection
