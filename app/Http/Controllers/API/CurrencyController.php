<?php

namespace App\Http\Controllers\API;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CurrencyRequest;
use App\Http\Requests\API\SearchCurrencyRequest;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    public function __construct(private CurrencyRepositoryInterface $currencyRepo) {}

    public function index(Request $request)
    {
        try {
            $currencies = null;
            if($request->type && $request->type == 1)
            {
                $currencies = $this->currencyRepo->getAllCurrencies();                
            }else{
                $currencies = $this->currencyRepo->getAllpaginatedCurrencies();
            }
            return $this->sendResponse($currencies, 'Currencies list retrieved successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CurrencyRequest $request)
    {
        DB::beginTransaction(); 
        try {
            $currency = $this->currencyRepo->createCurrency($request->all());
            DB::commit(); 
            return $this->sendResponse($currency, 'Currency added successfully.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $currencies = $this->currencyRepo->findCurrencyById($id); 
            return $this->sendResponse($currencies, 'Currency retrieved successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CurrencyRequest $request, $id)
    {
        DB::beginTransaction(); 
        try {
            $currency = $this->currencyRepo->updateCurrency($id, $request->all());
            DB::commit(); 
            return $this->sendResponse($currency, 'Currency updated successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack(); 
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction(); 
        try {
            $this->currencyRepo->deleteCurrency($id);
            DB::commit(); 
            return $this->sendResponse(null, 'Currency deleted successfully.', Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack(); 
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(SearchCurrencyRequest $request)
    {
        try {
            $currencies = $this->currencyRepo->searchCurrencies($request->input('query'));
            return $this->sendResponse($currencies, 'Search results retrieved successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
