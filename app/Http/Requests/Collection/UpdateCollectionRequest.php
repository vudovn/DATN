<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
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
        if (is_string($this->idProduct)) {
            $this->merge([
                'idProduct' => array_map('trim', explode(',', $this->idProduct))
            ]);
        }
        return [
            'name' => 'required',
            'thumbnail' => 'required',
            'idProduct' => 'min:2',
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
