@if($model->searchable)
    {{ Form::open(['url' => url()->current(),'method' => 'GET']) }}
    <div class="form-row">
        <div class="col-md-4 form-group">
            {{ Form::select('types[]',$model->searchable,null,[
            'class' => 'form-control '
            ]) }}
        </div>
        <div class="col-md-4 form-group">
            {{ Form::text('values[]',null,[
            'class' => 'form-control '
            ]) }}
        </div>
        <div class="col-md-4 form-group">
            {{ Form::submit('Search',[
            'class' => 'btn btn-success'
            ]) }}
            <a href="{{ route(Request::route()->getName()) }}" class="btn btn-info">Refresh</a>
        </div>
    </div>
    {{ Form::close() }}
@endif
