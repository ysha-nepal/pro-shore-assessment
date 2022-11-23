@php $options = form_options(get_defined_vars()) @endphp

<div class="field">
    {{ Form::label($name, $label, ['class' => 'label']) }}
    @php if(!isset($value)) $value = true @endphp
    <div class="control">
        @if($value)
        {{ Form::$type($name,$model->$name , $options) }}
        @else
        {{ Form::$type($name,$options) }}
        @endif
    </div>
    @error($name)
    <p class="help text-red-500">
        {{ $message }}
    </p>
    @enderror
</div>
