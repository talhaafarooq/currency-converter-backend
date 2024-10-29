<?php

namespace App\Repositories\Services;

use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Models\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAllCurrencies()
    {
        return Currency::all();
    }

    public function createCurrency(array $data){
        return Currency::create($data);
    }

    public function updateCurrency($id, array $data){
        $currency = $this->findCurrencyById($id);
        $currency->update($data);
        return $currency;
    }

    public function findCurrencyById(int $id)
    {
        return Currency::findOrFail($id);
    }

    public function deleteCurrency($id){
        $currency = $this->findCurrencyById($id);
        $currency->delete();
    }
    public function searchCurrencies($query){
        return Currency::where('name', 'LIKE', "%{$query}%")
            ->orWhere('symbol', 'LIKE', "%{$query}%")
            ->get();
    }
}
