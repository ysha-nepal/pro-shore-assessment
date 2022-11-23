<div class="form-row">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('values[MAIL_FROM_NAME]',__('core::setting.email.sender_name')) }}
            <div class="input-group mb-3">
                {{ Form::text('values[MAIL_FROM_NAME]',null,[
                'class'=>'form-control',
                'placeholder'=>'MAIL_FROM_NAME'
                ]) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('values[MAIL_FROM_ADDRESS]',__('core::setting.email.default_email')) }}
            <div class="input-group mb-3">
                {{ Form::text('values[MAIL_FROM_ADDRESS]',null,[
                'class'=>'form-control',
                'placeholder'=>'MAIL_FROM_ADDRESS'
                ]) }}
            </div>
        </div>
    </div>

    <fieldset>
        <legend>{{__('core::setting.email.mail_settings')}}</legend>
        <div class="row">
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_MAILER]',__('core::setting.email.mail_mailer')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_MAILER]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_mailer')
                    ]) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_HOST]',__('core::setting.email.mail_host')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_HOST]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_host')
                    ]) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_USERNAME]',__('core::setting.email.mail_username')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_USERNAME]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_username')
                    ]) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_PASSWORD]',__('core::setting.email.mail_password')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_PASSWORD]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_password')
                    ]) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_PORT]',__('core::setting.email.mail_port')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_PORT]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_port')
                    ]) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('values[MAIL_ENCRYPTION]',__('core::setting.email.mail_encryption')) }}
                <div class="input-group mb-3">
                    {{ Form::text('values[MAIL_ENCRYPTION]',null,[
                    'class'=>'form-control',
                    'placeholder'=>__('core::setting.email.mail_encryption')
                    ]) }}
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group col-md-12 mt-2">
        {{ Form::label('values[template]',__('core::setting.email.template')) }}
        <div class="mb-3 ">
            {{ Form::textarea('values[template]',null,[
            'class'=>'form-control editor',
            ]) }}
        </div>
    </div>

</div>


<fieldset class="mt-2 mb-2">
    <legend>
       {{__('core::setting.email.test_email')}}
    </legend>
    <div class="row d-flex align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                {{ Form::text('test_email',null,[
                'class'=>'form-control',
                'placeholder' => 'test@gmail.com',
                'id' => 'test_email'
                ]) }}
            </div>
        </div>
        <div class="form-group col-md-2">
            <button data-url="{{ route('api.settings.email') }}" type="button" class="btn btn-outline-success"
                id="test_email_sender"><i class="bi bi-send"></i> {{__('core::setting.email.send')}}</button>
        </div>
        <div class="form-group col-md-4 test_email_result">

        </div>
    </div>
</fieldset>
