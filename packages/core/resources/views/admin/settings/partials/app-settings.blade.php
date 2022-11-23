<div class="form-group">
    {{ Form::label('values[manual]',__('core::setting.common.Manual')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[manual]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.common.Manual')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[pagination]',__('core::setting.common.name')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[pagination]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.common.name')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[lang]',__('core::setting.common.Lang')) }}
    <div class="input-group mb-3">
        {{ Form::select('values[lang]',['en' => 'English','np' => 'Nepali'],null,[
        'class'=>'form-control',
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[google_api_key]',__('core::setting.app.google_api_key')) }}
    <div class="input-group mb-3">
        {{ Form::text('values[google_api_key]',null,[
        'class'=>'form-control',
        'placeholder'=>__('core::setting.app.google_api_key')
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[backup]',__('core::setting.app.backup')) }}
    <div class="input-group mb-3">
        {{ Form::select('values[backup]',config('core.dropdown.status'),null,[
        'class'=>'form-control',
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('values[clear_backup]',__('core::setting.app.clear_backup')) }}
    <div class="input-group mb-3">
        {{ Form::select('values[clear_backup]',config('core.dropdown.backups'),null,[
        'class'=>'form-control',
        ]) }}
    </div>
</div>
