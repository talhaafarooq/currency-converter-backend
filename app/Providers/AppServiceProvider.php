<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    ConversionRepositoryInterface,
    CurrencyRepositoryInterface
};

use App\Repositories\Services\{
    ConversionRepository,
    CurrencyRepository
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interfaces to their corresponding implementations
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(ConversionRepositoryInterface::class, ConversionRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
