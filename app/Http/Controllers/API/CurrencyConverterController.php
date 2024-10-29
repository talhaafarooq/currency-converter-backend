<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ConversionRepositoryInterface;
use App\Http\Requests\API\CurrencyConvertRequest;

class CurrencyConverterController extends Controller
{
    public function __construct(private ConversionRepositoryInterface $conversionRepo) {}

    public function convert(CurrencyConvertRequest $request)
    {
        DB::beginTransaction(); // Start the transaction
        
        try {
            $convertedAmount = $this->conversionRepo->convertCurrency(
                $request->from_currency_id,
                $request->to_currency_id,
                $request->amount
            );

            DB::commit(); // Commit the transaction if everything is successful
            return $this->sendResponse(['converted_amount' => $convertedAmount], "Amount converted successfully.", Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an error
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
