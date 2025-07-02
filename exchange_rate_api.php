<?php

// --------------Interface (Open)--------------- //

interface ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate;
}

// --------------Interface (Close)--------------- //

// --------------MoneyNow (Open)--------------- //

class MoneyNowProvider implements ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate
    {
        // Getting value from the MoneyNow.com thirdparty API call
        $rate = 85.70123;
        return new CurrencyRate($rate);
    }
}

// --------------MoneyNow (Closed)--------------- //


// --------------FinanceMagic (Open)--------------- //

class FinanceMagicProvider implements ExchangeRateProviderInterface
{
    public function getRate(): CurrencyRate
    {
        // Getting value from the FinanceMagic.com thirdparty API call
        $rate = 85.69823;
        return new CurrencyRate($rate);
    }
}

// --------------FinanceMagic (Closed)--------------- //


// Decimal value Formatting
class CurrencyRate
{
    private float $rate;

    public function __construct(float $rate)
    {
        // round to two decimal points
        $this->rate = round($rate, 2);
    }

    public function getFormatted(): string
    {
        return number_format($this->rate, 2, '.', '');
    }

    public function getRaw(): float
    {
        return $this->rate;
    }
}

// --------------LOG (Open)--------------- //
class Logger
{
    public static function info(string $message): void
    {
        echo "[LOG INFO] " . $message . PHP_EOL;
    }
}

// --------------LOG (Closed)--------------- //


// --------------Logging Details (Open)--------------- //

class LoggingDecorator implements ExchangeRateProviderInterface
{
    private ExchangeRateProviderInterface $provider;

    public function __construct(ExchangeRateProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getRate(): CurrencyRate
    {
        Logger::info("LogInfoOneFile - From " . get_class($this->provider));
        $rate = $this->provider->getRate();
        Logger::info("LogInfoOneFile - Received rate: " . $rate->getFormatted());
        return $rate;
    }
}

// --------------Logging Details (Closed)--------------- //


// --------------Enable Caching (Open)--------------- //

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

// --------------Enable Caching (Closed)--------------- //


// --------------Money rate providers (Open)--------------- //

class ProviderFactory
{
    public static function make(string $name): ExchangeRateProviderInterface
    {
        return match (strtolower($name)) {
            'moneynow' => new LoggingDecorator(
                new CachingDecorator(new MoneyNowProvider()) //cached
            ),
            'financemagic' => new LoggingDecorator(
                new FinanceMagicProvider() //not cached since it mentioned in requirement as optional
            ),
            default => throw new InvalidArgumentException("Unknown rate provider: $name"),
        };
    }
}

// --------------Money rate providers (Closed)--------------- //


// --------------Service (Open)--------------- //

class GetUSDExchangeRateService
{
    public function __invoke(string $providerName): string
    {
        $provider = ProviderFactory::make($providerName);
        return $provider->getRate()->getFormatted();
    }
}

// --------------Service (Closed)--------------- //



$service = new GetUSDExchangeRateService();

echo PHP_EOL;
echo "Value from MoneyNow: " . $service('moneynow') . PHP_EOL;
echo PHP_EOL;
echo "Value from FinanceMagic: " . $service('financemagic') . PHP_EOL;
