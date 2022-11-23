<a title="{{ $action['placeholder'] ?? 'Edit' }}" type="button" href="{{route($action['route'],[$record->id] + $params)}}" data-toggle="tooltip" class="text-primary" data-placement="top">
    <i class="{{ $action['icon'] }}"></i>
</a>



