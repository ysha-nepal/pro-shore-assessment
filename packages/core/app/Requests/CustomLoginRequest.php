<?php

namespace Core\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Fortify;

class CustomLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        dd('a');
        return [
            'phone' => 'string|nullable',
             Fortify::username() => 'required_unless:phone,null|string',
            'password' => 'required|string',
        ];
    }
}
