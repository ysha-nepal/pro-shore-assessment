@php $options = form_options(get_defined_vars()) @endphp

<div class="field">
    {{ Form::label($name, $label, ['class' => 'label']) }}
    <div class="control">
       {{ Form::textarea($name,null,[
           'class' => 'input resize rounded-md'
       ]) }}
    </div>
    @error($name)
    <p class="help text-red-500">
        {{ $message }}
    </p>
    @enderror
</div>
