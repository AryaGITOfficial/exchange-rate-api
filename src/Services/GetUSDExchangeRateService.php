<?php

namespace App\Services;

use App\Factories\ProviderFactory;

class GetUSDExchangeRateService
{
    public function __invoke(string $providerName): string
    {
        $provider = ProviderFactory::make($providerName);
        return $provider->getRate()->getFormatted();
    }
}

?>