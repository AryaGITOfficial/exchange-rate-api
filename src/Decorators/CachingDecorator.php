<?php

namespace App\Decorators;

use App\Interfaces\ExchangeRateProviderInterface;
use App\ValueObjects\CurrencyRate;

class CachingDecorator implements ExchangeRateProviderInterface
{
    private ExchangeRateProviderInterface $provider;
    private static array $cache = [];

    public function __construct(ExchangeRateProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getRate(): CurrencyRate
    {
        $key = get_class($this->provider);

        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        $rate = $this->provider->getRate();
        self::$cache[$key] = $rate;
        return $rate;
    }
}

?>