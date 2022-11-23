<div class="form-row">

    <div class="form-group col-md-12">
        {{ Form::label('title',__('core::form.common.title'). ' (*)') }}
        <div class="input-group mb-3">
            {{ Form::text('title',null,[
            'class'=>'form-control' . ($errors->has('title') ? ' is-invalid' : ""),
            'placeholder'=>__('core::form.common.title'),
            'data-slug' => '#slug'
            ]) }}
            @include('core::admin.layouts.components.validation',['name' => 'title'])
        </div>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('slug',__('core::form.common.slug').' (*)') }}
        <div class="input-group mb-3">
            {{ Form::text('slug',null,[
            'class'=>'form-control' . ($errors->has('slug') ? ' is-invalid' : ""),
            'placeholder'=>__('core::form.common.slug')
            ]) }}
            @include('core::admin.layouts.components.validation',['name' => 'slug'])
        </div>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('subject',__('core::form.emailtemplates.subject') .' (*)') }}
        <div class="input-group mb-3">
            {{ Form::text('subject',null,[
            'class'=>'form-control' . ($errors->has('subject') ? ' is-invalid' : ""),
            'placeholder'=>__('core::form.emailtemplates.subject'),
            ]) }}
            @include('core::admin.layouts.components.validation',['name' => 'subject'])
        </div>
    </div>
    <div class="form-group col-md-12">
        @include('core::admin.layouts.components.validation',['name' => 'content'])
        {{ Form::label('content',__('core::form.emailtemplates.content')) }}
        <div class="mb-3">
            {{ Form::textarea('content',$model->content ?? setting_helper('email-settings','template'),[
            'class'=>'form-control editor' . ($errors->has('content') ? ' is-invalid' : ""),
            'placeholder'=>__('core::form.emailtemplates.content')
            ]) }}
        </div>

    </div>
</div>
