<?php

namespace App\Providers;

use App\Interfaces\ExchangeRateProviderInterface;
use App\ValueObjects\CurrencyRate;

class MoneyNowProvider implements ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate
    {
        // Getting value from the MoneyNow.com thirdparty API call

        // $rate = 85.7; // test value
        // $rate = 85.712345; // test value
        $rate = 85.701234; // test value
        return new CurrencyRate($rate);
    }
}


?>