<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface
{
    public function getAllCurrencies();
    public function createCurrency(array $data);
    public function updateCurrency($id, array $data);
    public function deleteCurrency($id);
    public function searchCurrencies($query);
}
