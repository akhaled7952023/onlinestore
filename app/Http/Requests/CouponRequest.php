<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        'code_coupon' => ['required', 'min:4', 'max:10', 'unique:coupons,code_coupon,' . $this->id],
        'discount_type' => ['required', 'in:percentage,fixed'],
        'discount_value' => ['required', 'numeric', 'min:1'],
        'start_date' => ['required', 'date', 'after_or_equal:now'],
        'end_date' => ['required', 'date', 'after:start_date'],
        'min_cart_value' => ['nullable', 'numeric', 'min:1'],
        'limit' => ['required', 'numeric', 'min:1'],
        'is_active' => ['required', 'boolean'],
        ];
    }
}
