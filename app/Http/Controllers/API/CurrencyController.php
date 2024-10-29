<?php

namespace App\Http\Controllers\API;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CurrencyConvertRequest;
use App\Repositories\Contracts\ConversionRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    public function __construct(
        private CurrencyRepositoryInterface $currencyRepo,
        private ConversionRepositoryInterface $conversionRepo
    ) {}

    public function getCurrencies()
    {
        try {       
            $currencies = $this->currencyRepo->getAllCurrencies();
            return $this->sendResponse($currencies, 'Currencies list retrieved successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

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
