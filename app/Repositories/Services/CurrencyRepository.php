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

    public function findCurrencyById(int $id)
    {
        return Currency::findOrFail($id);
    }
}
