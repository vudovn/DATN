<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        dd($this->all());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
        return [
            'name' => 'required|unique:attribute_category',
            // category_id[]: mảng các id danh mục
            'category' => 'required|array|min:1',

        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Tên thuộc tính không được để trống',
            'name.unique' => 'Tên thuộc tính đã tồn tại',
            'category.required' => 'Danh mục không được để trống',
            'category.min' => 'Danh mục không hợp lệ',
        ];
    }
}
