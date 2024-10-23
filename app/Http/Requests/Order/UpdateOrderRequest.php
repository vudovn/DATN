<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Thay đổi thành true để cho phép
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'payment_status' => 'required|in:pending,completed,failed',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'quantity.*' => 'required|integer|min:1',
        ];
    }
}
