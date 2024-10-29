<?php

namespace App\Repositories\Services;

use App\Models\Currency;
use App\Models\ConversionHistory;
use App\Repositories\Contracts\ConversionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConversionRepository implements ConversionRepositoryInterface
{
    public function convertCurrency($fromCurrencyId, $toCurrencyId, $amount)
    {
        return DB::transaction(function () use ($fromCurrencyId, $toCurrencyId, $amount) {
            // Fetch the currencies with exception handling
            try {
                $fromCurrency = Currency::findOrFail($fromCurrencyId);
                $toCurrency = Currency::findOrFail($toCurrencyId);
            } catch (ModelNotFoundException $e) {
                throw new \InvalidArgumentException("Currency not found.");
            }

            // Perform the conversion calculation
            $convertedAmount = $amount * ($toCurrency->exchange_rate_to_usd / $fromCurrency->exchange_rate_to_usd);
            $roundedAmount = round($convertedAmount, 2);

            // Log the conversion in ConversionHistory
            ConversionHistory::create([
                'from_currency_id' => $fromCurrencyId,
                'to_currency_id' => $toCurrencyId,
                'amount' => $amount,
                'converted_amount' => $roundedAmount,
                'conversion_date' => now(),
            ]);

            // Return the rounded converted amount
            return $roundedAmount;
        });
    }
}
