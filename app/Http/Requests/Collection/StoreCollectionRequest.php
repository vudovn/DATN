<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCollectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function __construct(Request $request)  // Fix the typo here
    {
        // dd($request->all());  
    }
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
        if (is_string($this->skus)) {
            $this->merge([
                'skus' => array_map('trim', explode(',', $this->skus))
            ]);
        }
        return [
            'name' => 'required',
            'thumbnail' => 'required',
            'skus' => 'min:2',
            // 'meta_title' => 'required',
            // 'meta_description' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Không được để trống tên bộ sưu tập',
            'thumbnail.required' => 'Hãy chọn ảnh bìa cho bộ sưu tập',
            'idProduct.min' => 'Hãy chọn ít nhất 3 sản phẩm cho bộ sửu tập',
        ];
    }
}
