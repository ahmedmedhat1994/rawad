<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'username'      => 'required|max:20|unique:users',
                    'email'         => 'required|email|max:255|unique:users',
                    'mobile'        => 'required|numeric|unique:users',
                    'status'        => 'required',
                    'password'      => 'required|min:8',
                    'photo'    => 'nullable|max:20000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'username'      => 'required|max:20|unique:users,username,'.$this->input('id'),
                    'email'         => 'required|email|max:255|unique:users,email,'.$this->input('id'),
                    'mobile'        => 'required|numeric|unique:users,mobile,'.$this->input('id'),
                    'status'        => 'required',
                    'password'      => 'nullable|min:8',
                    'photo'    => 'nullable|max:20000'
                ];
            }
            default: break;
        }
    }
}
