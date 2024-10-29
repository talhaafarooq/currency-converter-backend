<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::insert([
            ['code' => 'USD', 'name' => 'US Dollar', 'exchange_rate_to_usd' => 1.0],
            ['code' => 'EUR', 'name' => 'Euro', 'exchange_rate_to_usd' => 0.85],
            ['code' => 'GBP', 'name' => 'British Pound', 'exchange_rate_to_usd' => 0.75],
            ['code' => 'JPY', 'name' => 'Japanese Yen', 'exchange_rate_to_usd' => 110.0],
        ]);
    }
}
