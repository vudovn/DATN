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
            'email' => 'required|email|unique:users,email, '.$this->id.'',
            'name' => 'required',
            'phone' => 'required|unique:users,phone, '.$this->id.'',
            'user_catalogue_id' => 'gt:0'
        ];
    }

    public function messages():array {
        return [
            'user_catalogue_id.gt' => 'You have not selected a user group'
        ];
    }
}
