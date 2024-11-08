<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'note' => 'nullable|string',
            'payment_method' => 'required|string|max:50',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled', // tùy theo các giá trị trạng thái của bạn
            'payment_status' => 'required|in:completed,pending,failed,refunded', // thay đổi theo giá trị trạng thái thanh toán
            'address' => 'required|string|max:255',
            'total_amount' => 'required|min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên khách hàng là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'payment_method.required' => 'Phương thức thanh toán là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'payment_status.required' => 'Trạng thái thanh toán là bắt buộc.',
            'address.required' => 'Địa chỉ giao hàng là bắt buộc.',
            'total_amount.required' => 'Tổng tiền là bắt buộc.',
        ];
    }
}
