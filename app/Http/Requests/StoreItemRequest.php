<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:140'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'category' => ['required', 'string', 'max:100'],
            'condition' => ['required', 'string', 'max:100'],
            'min_rental_days' => ['required', 'integer', 'min:1', 'max:365'],
            'pricing_type' => ['required', 'in:starting_price,per_day'],
            'price_amount' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
