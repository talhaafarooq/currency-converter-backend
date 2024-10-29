<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface
{
    public function getAllCurrencies();
    public function findCurrencyById(int $id);
}
