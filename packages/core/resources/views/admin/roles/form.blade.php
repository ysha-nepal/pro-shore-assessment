@inject('permission_helper','Core\Helpers\PermissionHelper')
@php $selected = $permission_helper->selected($model->permissions) @endphp
<div class="form-group">
    {{ Form::label('name',__('core::form.common.name')) }}
    <div class="input-group mb-3">
        {{ Form::text('name',null,[
        'class'=>'form-control' . ($errors->has('name') ? ' is-invalid' : ""),
        'placeholder'=>'Role Name'
        ]) }}
        @include('core::admin.layouts.components.validation',['name' => 'name'])
    </div>
</div>
<div class="form-group">
    {{ Form::label('permissions[]', __('core::form.roles.choose_permission')) }} <label class="text-danger ml-1">*</label>
    @foreach($permission_helper->dropdown() as $package => $permissions)
        <div class="row">
            <div class="col-2">
                <div class="form-check-danger form-check form-switch">
                    <input class="form-check-input permission-trigger" type="checkbox" id="{{ "$package-trigger" }}" data-selector={{ ".$package-permission" }}>
                    <label class="form-check-label" for="{{ "$package-trigger" }}">{{ \Illuminate\Support\Str::ucfirst($package) }}</label>
                </div>
            </div>
            <div class="col-10">
                <div class="row">
                    @foreach ($permissions as $key => $permission)
                        <div class="col-3 mb-2">
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input {{ "$package-permission" }}" id="{{ Str::slug($permission->name) }}" value="{{ $permission->id }}" {{
                                in_array($permission->id, $selected) ? 'checked' : '' }} type="checkbox" name="permissions[]">
                                <label class="form-check-label" for="{{ Str::slug($permission->name) }}">{{__("$permission->package_name::permission.$permission->name")}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    @error('permissions')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
