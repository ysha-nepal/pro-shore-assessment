{{ Form::open(['url' => url()->current(),'method' => 'GET','class'=>'form-group row']) }}
<div class="row mb-2">
    <div class="col-md-6">
        {{ Form::text('title',$params['title'] ?? null,['class' => 'form-control','placeholder' => __($package. '::table.Search By Title')]) }}
    </div>
    <div class="col-md-6">
        {{ Form::select('filter',config('event.dropdown.filter'),$params['filter'] ?? null,[
           'class'=>'form-control',
           ]) }}
    </div>
</div>
<div class="row mt-2 mb-2">
    <div class="col-md-4">
        {{ Form::submit(__($package. '::table.Search'),['class' => 'btn btn-success']) }}
        {{ Form::submit(__($package. '::table.Export'),['class' => 'btn btn-success','name' => 'SUBMIT']) }}
        <a href="{{ route(Request::route()->getName()) }}" class="btn btn-info">{{__($package. '::table.Refresh')}}</a>
    </div>
</div>
{{ Form::close() }}
