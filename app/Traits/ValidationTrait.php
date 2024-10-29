<?php

namespace App\Traits;

use App\Enums\MessageEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'statusCode' => 422,
            'errors' => $validator->errors(),
            'message' => MessageEnum::VALIDATION_ERROR_MESSAGE,
        ], 422));
    }
}
