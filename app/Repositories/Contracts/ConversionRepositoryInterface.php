<?php

namespace App\Repositories\Contracts;

interface ConversionRepositoryInterface
{
    public function convertCurrency($fromCurrency, $toCurrency, $amount);
}
