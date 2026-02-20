<?php

namespace App\Http\Requests\Api\V1\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
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
            'quantity'     => 'sometimes|integer|min:1',
            'price'        => 'sometimes|numeric|min:0',
            'product_name' => 'sometimes|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'quantity.min'  => 'Quantity must be at least 1.',
            'price.min'     => 'Price cannot be negative.',
        ];
    }
}
