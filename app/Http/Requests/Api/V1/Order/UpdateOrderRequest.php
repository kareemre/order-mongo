<?php

namespace App\Http\Requests\Api\V1\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status'                    => 'sometimes|string|in:pending,processing,shipped,delivered,cancelled',
            'shipping_address'          => 'sometimes|array',
            'shipping_address.street'   => 'required_with:shipping_address|string|max:255',
            'shipping_address.city'     => 'required_with:shipping_address|string|max:255',
            'shipping_address.zip'      => 'required_with:shipping_address|string|max:20',
        ];
    }
}
