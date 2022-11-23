{{ Form::open(['method' => 'DELETE' , 'class' => 'inline' , 'route' => [$action['route'], [$record->id] + $params]]) }}
    <button title="{{ $action['placeholder'] ?? 'Delete' }}" type="submit" data-toggle="tooltip" class="text-danger bg-transparent border-0" data-placement="top" onclick="javascript:return confirm('Are you sure you want to delete?');" title="{{ $action['placeholder'] ?? 'Delete' }}">
        <i class="bi bi-trash"></i>
    </button>
{{ Form::close() }}



