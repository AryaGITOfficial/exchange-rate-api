<?php

namespace App\Interfaces;

use App\ValueObjects\CurrencyRate;

interface ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate;
}

?>