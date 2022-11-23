{{ Form::open(['url' => url()->current(),'method' => 'GET','class'=>'form-group row']) }}
@inject('activity_helper','Core\Helpers\ActivityHelper')
<div class="row mb-2">
    <div class="col-md-4">
        {{ Form::select('event',$activity_helper->getEventsDropdown(),$params['event'] ?? null,[
           'class'=>'form-control'
           ]) }}
    </div>
</div>
<div class="row mt-2 mb-2">
    <div class="col-md-4">
        {{ Form::submit(__($package. '::table.Search'),['class' => 'btn btn-success']) }}
        <a href="{{ route(Request::route()->getName()) }}" class="btn btn-info">{{__($package. '::table.Refresh')}}</a>
    </div>
</div>
{{ Form::close() }}
