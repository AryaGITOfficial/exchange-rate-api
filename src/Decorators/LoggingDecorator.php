<?php

namespace App\Decorators;

use App\Interfaces\ExchangeRateProviderInterface;
use App\ValueObjects\CurrencyRate;
use App\Utils\Logger;

class LoggingDecorator implements ExchangeRateProviderInterface
{
    private ExchangeRateProviderInterface $provider;

    public function __construct(ExchangeRateProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getRate(): CurrencyRate
    {
        Logger::info("LogInfoFolder - From " . get_class($this->provider));
        $rate = $this->provider->getRate();
        Logger::info("LogInfoFolder - Received rate: " . $rate->getFormatted());
        return $rate;
    }
}

?>