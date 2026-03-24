<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var Item $item */
        $item = $this->route('item');

        return $this->user() !== null && $this->user()->can('update', $item);
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
