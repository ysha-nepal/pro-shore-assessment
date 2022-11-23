@inject('role_helper','Core\Helpers\RoleHelper')
{{ Form::media($model,['button' => __('core::form.users.upload_your_photo'),'type' => 'image']) }}
<div class="form-row">
    <div class="form-group col-12">
        {{ Form::label('name',__('core::form.common.name') . '(*)' )}}
        <div class="input-group mb-3">
            {{ Form::text('name',null,[
            'class'=>'form-control' . ($errors->has('name') ? ' is-invalid' : ""),
            'placeholder'=>__('core::form.common.name')
            ]) }}
            @include('core::admin.layouts.components.validation',['name' => 'name'])
        </div>
    </div>
    <!-- /.form group -->
    <div class="form-group col-12">
        {{ Form::label('email',__('core::form.users.email') . '(*)' ) }}
        <div class="input-group mb-3">
            {!! Form::email('email',null,[
            'class'=>'form-control' . ($errors->has('email') ? ' is-invalid' : ""),
            'placeholder'=>'email@example.com',
            $model->exists ? "disabled" : ""
            ]) !!}
            @include('core::admin.layouts.components.validation',['name' => 'email'])
        </div>
    </div>
    @if(!$model->exists)
    <div class="form-group col-12">
        {{ Form::label('password',__('core::form.users.password') . '(*)' ) }}
        <div class="input-group mb-3">
            {!! Form::password('password',[
            'class'=>'form-control' . ($errors->has('password') ? ' is-invalid' :
            ""),'placeholder'=>__('core::form.users.password')
            ]) !!}
            @include('core::admin.layouts.components.validation',['name' => 'password'])
        </div>
    </div>
    <div class="form-group col-12">
        {{ Form::label('password_confirmation',__('core::form.users.confirm_password') . '(*)' ) }}
        <div class="input-group mb-3">
            {!! Form::password('password_confirmation',[
            'class'=>'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' :
            ""),'placeholder'=>__('core::form.users.confirm_password')
            ]) !!}
            @include('core::admin.layouts.components.validation',['name' => 'password_confirmation'])
        </div>
    </div>
    @endif
    <div class="form-group col-12">
        {{ Form::label('designation',__('core::form.users.designation')) }}
        <div class="input-group mb-3">
            {!! Form::text('designation',null,[
            'class'=>'form-control' . ($errors->has('designation') ? ' is-invalid' : ""),'placeholder'=>__('core::form.users.designation')
            ]) !!}
            @include('core::admin.layouts.components.validation',['name' => 'designation'])
        </div>
    </div>
    <div class="form-group col-12">
        {{ Form::label('roles[]',__('core::form.users.select_roles') . '(*)' ) }}
        <div class="input-group mb-3">
            {!! Form::select('roles[]',$role_helper->dropdown(),null,[
            'class'=>'form-control select2' . ($errors->has('roles') ? ' is-invalid' : ""),
            'multiple' => 'multiple',
            'data-placeholder'=>__('core::form.users.select_roles')
            ]) !!}
            @include('core::admin.layouts.components.validation',['name' => 'roles'])
        </div>
    </div>
</div>
