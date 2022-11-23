@php $options = form_options(get_defined_vars()) @endphp
<div class="field">
    {{ Form::label($name, $label, ['class' => 'label']) }}
    {{ Form::select($name, $dropdowns, $selected ?? null,$options) }}
</div>
