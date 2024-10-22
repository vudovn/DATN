<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email, ' . $this->id . '',
            'name' => 'required',
            'phone' => 'required|unique:users,phone, ' . $this->id . '',
            // 'roles' => 'required|array|min:1',
            // 'roles.*' => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Không được để trống tên',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại ',
            // 'roles.required' => 'Không được để trống vai trò',
            // 'roles.array' => 'Vai trò phải là một mảng',
            // 'roles.*.exists' => 'Vai trò không hợp lệ',
        ];
    }
}
