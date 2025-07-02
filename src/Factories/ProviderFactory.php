<?php

namespace App\Factories;

use App\Interfaces\ExchangeRateProviderInterface;
use App\Providers\MoneyNowProvider;
use App\Providers\FinanceMagicProvider;
use App\Decorators\LoggingDecorator;
use App\Decorators\CachingDecorator;

class ProviderFactory
{
    public static function make(string $name): ExchangeRateProviderInterface
    {
        return match (strtolower($name)) {
            'moneynow' => new LoggingDecorator(
                new CachingDecorator(new MoneyNowProvider())
            ),
            'financemagic' => new LoggingDecorator(
                new FinanceMagicProvider()
                // new CachingDecorator(new FinanceMagicProvider())

            ),
            default => throw new \InvalidArgumentException("Unknown provider: $name"),
        };
    }
}

?>