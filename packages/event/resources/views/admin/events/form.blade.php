{{ Form::media($model,['button' => 'Upload Image','type' => 'image']) }}
<div class="form-row row">
    <div class="form-group col-md-12">
        {{Form::lang($model,'en','title',__($package.'::form.common.title') . '(*)',true)}}
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
    <div class="form-group col-md-6">
        {{ Form::label('start_date',__($package.'::form.common.Start Date'). ' (*)') }}
        <div class="input-group mb-3">
            {{ Form::text('start_date',null,['class'=>'form-control nepali-date' . ($errors->has('start_date_ad') ? ' is-invalid' : ""),
                'placeholder'=>'Enter start_date','data-ad-elem' => '#start_date_ad']
            ) }}
            @include('core::admin.layouts.components.validation',['name' => 'start_date_ad'])
        </div>
    </div>
    {{Form::hidden('start_date_ad',null,['id' => 'start_date_ad'])}}
    <div class="form-group col-md-6">
        {{ Form::label('end_date',__($package.'::form.common.End Date'). ' (*)') }}
        <div class="input-group mb-3">
            {{ Form::text('end_date',null,['class'=>'form-control nepali-date' . ($errors->has('end_date_ad') ? ' is-invalid' : ""),
                    'placeholder'=>'Enter end date','data-ad-elem' => '#end_date_ad']) }}
            @include('core::admin.layouts.components.validation',['name' => 'end_date_ad'])
        </div>
    </div>
    {{Form::hidden('end_date_ad',null,['id' => 'end_date_ad'])}}
    <div class="form-group col-md-12">
        {{Form::langTextarea($model,'en','description',__($package.'::form.common.Description') . '(*)')}}
    </div>
</div>

@section('nepali_fields')
    <div class="form-group col-md-12">
        {{Form::lang($model,'np','title',__($package.'::form.common.title'))}}
    </div>
    <div class="form-group col-md-12">
        {{Form::langTextarea($model,'np','description',__($package.'::form.common.Description'))}}
    </div>
@endsection
