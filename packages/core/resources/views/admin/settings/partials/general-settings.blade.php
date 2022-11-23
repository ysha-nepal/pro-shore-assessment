{{ Form::settingMedia($model,['button' => __('core::setting.general.upload_logo'),'type' => 'image','field_name' => 'logo','']) }}
<div class="form-group">
    {{ Form::label('values[name]',__('core::setting.common.name')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[name]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.common.name')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[phone]',__('core::setting.general.phone')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[phone]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.phone')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[fax]',__('core::setting.general.fax')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[fax]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.fax')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[email]',__('core::setting.general.email')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[email]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.email')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[address]',__('core::setting.general.address')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[address]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.address')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[copyright]','CopyRight') }}
    <div class="input-group mb-3">
        {{ Form::text('values[copyright]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.copyright')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[powered]','Powered By') }}
    <div class="input-group mb-3">
        {{ Form::text('values[powered]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.general.powered')
        ]) }}
    </div>
</div>
