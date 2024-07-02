<?php

namespace App\Http\Requests\Backend;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {

            case 'POST':
                {
                    return [
                        'name.*' => ['required', UniqueTranslationRule::for('tags')->ignore('id')],
                        'status' => 'required',
                    ];
                };
            case 'PUT':
            {
                return [
                    'name.*' => ['required', UniqueTranslationRule::for('tags')->ignore($this->input('id'))],
                    'status' => 'required',

                ];
            }

            default:break;
        }
        return [
            //
        ];

    }


    public function messages(): array
    {
        return [
            'name.*.required' => trans('tags.name required'),
            'name.ar.unique_translation' => trans('tags.failed unique ar'),
            'name.en.unique_translation' => trans('tags.failed unique en'),
            'status.required' => trans('tags.status required'),
        ];
    }

}
