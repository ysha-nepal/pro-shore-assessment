<?php

Form::macro('media',function($model,$options){
    $defaults = [
        'field_name' => 'medias[]',
        'multiple' => false,
        'button' => 'Add Media',
        'type' => 'image'
    ];
    $field = $options['field_name'] ?? $defaults['field_name'];
    $options = array_merge($defaults, $options);
    $values = $model->media ? implode(',', $model->medias->pluck('id')->toArray()) : '';
    return view('core::admin.layouts.components.media',[
        'model' => $model,
        'field' => $field,
        'options' => $options,
        'values' => $values
    ]);
});

Form::macro('settingMedia',function($model,$options){
    $defaults = [
        'field_name' => 'medias[]',
        'multiple' => false,
        'button' => 'Add Media',
        'type' => 'image'
    ];
    $field = $options['field_name'] ?? $defaults['field_name'];
    $options = array_merge($defaults, $options);
    $values = $model->values;
    $media = isset($values[$field]) ? \Core\Models\Media::find($values[$field]) : null;
    return view('core::admin.layouts.components.settings.media',[
        'model' => $model,
        'field' => $field,
        'options' => $options,
        'values' => $values,
        'media' => $media
    ]);
});

Form::macro('lang',function($model,$key,$field,$label,$slug=false){
    return view('core::admin.layouts.components.language', [
        'model' => $model,
        'field' => $field,
        'key' => $key,
        'label' =>$label,
        'slug' => $slug
    ]);
});

Form::macro('langTextarea', function ($model,$key, $field, $label) {
    return view('core::admin.layouts.components.language-textarea', [
        'model' => $model,
        'field' => $field,
        'key' => $key,
        'label' => $label
    ]);
});
