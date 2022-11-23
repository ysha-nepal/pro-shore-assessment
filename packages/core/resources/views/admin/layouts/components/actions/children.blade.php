<a title="{{ $action['placeholder'] ?? 'Childrens' }}" type="button" href="{{route($action['route'],['parent_id' => $record->id])}}" data-toggle="tooltip" class="text-primary" data-placement="top">
    <i class="{{ $action['icon'] }}"></i>
</a>
