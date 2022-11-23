@if($action)
    @can($action['permission'])
        <a type="button"  href="{{ route($action['route'],$params) }}" class="btn btn-outline-primary px-4 rounded-0"><i class="bi bi-plus me-2"></i>{{__($package.'::admin.buttons.' . $ui->createBtn)}}</a>
    @endcan
@endif

