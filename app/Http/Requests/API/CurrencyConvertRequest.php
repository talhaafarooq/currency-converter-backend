<?php

namespace App\Http\Requests\API;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyConvertRequest extends FormRequest
{
    use ValidationTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'from_currency_id.required' => 'Please select the currency you are converting from.',
            'from_currency_id.exists' => 'The selected "From Currency" is invalid or does not exist.',
            'to_currency_id.required' => 'Please select the currency you are converting to.',
            'to_currency_id.exists' => 'The selected "To Currency" is invalid or does not exist.',
            'amount.required' => 'Please enter the amount to be converted.',
            'amount.numeric' => 'The amount must be a numeric value.',
            'amount.min' => 'The amount must be at least 0.01.',
        ];
    }
}
