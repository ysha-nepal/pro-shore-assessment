{{ Form::label("$field" . "[$key]", "$label") }}
<div class="mb-3">
    {{ Form::textarea("$field" . "[$key]",$model->getTranslation($field,$key),[
    'class'=>'editor' . ($errors->has("$field" . ".$key") ? ' is-invalid' : ""),
    ]) }}
    @include('core::admin.layouts.components.validation',['name' => "$field" . ".$key"])
</div>
