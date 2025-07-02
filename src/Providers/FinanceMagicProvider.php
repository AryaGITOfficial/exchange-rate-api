<?php

namespace App\Providers;

use App\Interfaces\ExchangeRateProviderInterface;
use App\ValueObjects\CurrencyRate;

class FinanceMagicProvider implements ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate
    {
        // Getting value from the FinanceMagic,com thirdparty API call
        $rate = 85.69823; // test sample value
        return new CurrencyRate($rate);
    }
}

?>