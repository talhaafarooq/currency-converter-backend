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
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'exchange_rate_to_usd' => 'required|numeric',
        ];

        if ($this->isMethod('post')) {
            $rules['name'] .= '|unique:currencies';
            $rules['code'] .= '|unique:currencies';
        }

        return $rules;
    }
}
