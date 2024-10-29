<?php

namespace App\Http\Requests\API;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    use ValidationTrait;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:currencies',
            'code' => 'required|string|max:10|unique:currencies',
            'exchange_rate_to_usd' => 'required|numeric',
        ];
    }
}
