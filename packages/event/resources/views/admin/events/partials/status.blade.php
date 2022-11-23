@if($model->status === "Upcoming")
    <span class="badge rounded-pill bg-primary">{{ $model->status }}</span>
@elseif($model->status === "Ongoing")
    <span class="badge rounded-pill bg-success">{{ $model->status }}</span>
@else
    <span class="badge rounded-pill bg-danger">{{ $model->status }}</span>
@endif
