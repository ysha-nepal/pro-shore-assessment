{{ Form::label("$field" . "[$key]", $label) }}
<div class="input-group mb-3">
    {{ Form::text("$field" . "[$key]",$model->getTranslation($field,$key),[
    'class'=>'form-control' . ($errors->has("$field" . ".$key") ? ' is-invalid' : ""),
    'placeholder'=>$label,
    'data-slug' => $slug ? "input[name='slug']" : ""
    ]) }}
    @include('core::admin.layouts.components.validation',['name' => "$field" . ".$key"])
</div>
