<div class="form-group">
    {{ Form::label('title',__('core::form.common.title') . '(*)') }}
    <div class="input-group mb-3">
        {{ Form::text('title',null,[
        'class'=>'form-control' . ($errors->has('title') ? ' is-invalid' : ""),
        'placeholder'=>__('core::form.common.title')
        ]) }}
        @include('core::admin.layouts.components.validation',['name' => 'title'])
    </div>
</div>
<div class="form-group">
    {{ Form::label('medias[]',__('core::form.medias.upload_media')) }}
    <div class="input-group mb-3">

        {{ Form::file('medias[]',null,[
        'class' => 'form-control'
        ]) }}
        @include('core::admin.layouts.components.validation',['name' => 'medias'])
    </div>
</div>

<div class="form-group">
    {{ Form::label('description',__('core::form.medias.description')) }}
    <div class="input-group mb-3">
        {{ Form::textarea('description',null,[
        'class'=>'form-control' . ($errors->has('description') ? ' is-invalid' : ""),'placeholder'=>__('core::form.medias.description')
        ]) }}
        @include('core::admin.layouts.components.validation',['name' => 'description'])
    </div>
</div>
