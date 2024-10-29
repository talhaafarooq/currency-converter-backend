<?php

namespace App\Http\Requests\API;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SearchCurrencyRequest extends FormRequest
{
    use ValidationTrait;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => 'required|string|max:255',
        ];
    }
}
