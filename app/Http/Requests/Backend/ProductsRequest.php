<?php

namespace App\Http\Requests\Backend;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
                        'name.*' => ['required', UniqueTranslationRule::for('product_categories')->ignore('id')],
                        'description' => 'required',
                        'price' => 'required|numeric',
                        'quantity' => 'required|numeric',
                        'product_category_id' => 'required',
                        'status' => 'required',
                        'tags.*' => 'required',
                        'document' => 'required',
//                        'document.*' => 'mimes:jpg,jpeg,png,gif|max:2000',
                    ];
                };
            case 'PUT':
            {
                return [
                    'name.*' => ['required', UniqueTranslationRule::for('products')->ignore($this->input('id'))],
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'quantity' => 'required|numeric',
                    'product_category_id' => 'required',
                    'status' => 'required',
                    'tags.*' => 'required',
                    'document' => 'required',
//                    'document.*' => 'mimes:jpg,jpeg,png,gif|max:2000',
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
            'name.*.required' => trans('categories.name required'),
            'name.ar.unique_translation' => trans('categories.failed unique ar'),
            'name.en.unique_translation' => trans('categories.failed unique en'),
            'status.required' => trans('categories.status required'),
        ];
    }

}
