<?php

namespace App\Repositories\Contracts;

interface CurrencyRepositoryInterface
{
    public function getAllCurrencies();
    public function getAllpaginatedCurrencies();
    public function findCurrencyById($id);
    public function createCurrency(array $data);
    public function updateCurrency($id, array $data);
    public function deleteCurrency($id);
    public function searchCurrencies($query);
}
