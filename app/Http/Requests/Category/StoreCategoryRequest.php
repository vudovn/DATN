<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        return [
            'name' => 'required|unique:categories,name|string|max:255',
            'publish'=>'required',
            // 'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            // 'meta_title' => 'nullable|string|max:255',
            // 'meta_description' => 'nullable|string|max:500',
            // 'meta_keyword' => 'nullable|string|max:255',
        ];
    }

    public function massages(): array {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Danh mục đã tồn tại',
            'thumbnail.required' => 'Ảnh đại diện chưa được chọn'
        ];
    }
}
