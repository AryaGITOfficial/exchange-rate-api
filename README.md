Since it should be possible to integrate more such external APIs in the future without changing core components, defined an interface ExchangeRateProviderInterface.php and each provider - MoneyNowProvider.php, FinanceMagicProvider.php- implements ExchangeRateProviderInterface.php interface. 
Also new providers in future can be added without changing existing code, just needed to update the factory.

Implimented Caching support for minimizing the number of thirdparty API requests.
The CachingDecorator.php wraps the provider and caches its response statically.
Here MoneyNowProvider is cached and FinanceMagicProvider is not cached (Just to satisfy this reference in requirement doc: - Some external services/APIs may not require caching.)

Added logging to track which provider was used and data from where. Also the logging is reusable to any provider.

Since Currency should always be in two decimal points format, the CurrencyRate.php is used. Which helps in handling the value formatting.

All files represent Single Responsibility classes in a structured way. Also logging, caching, formatting are done in reusable way.

To improve readability and easy to handle followed a standard php folder structure.
Since the requrement mentions “You may write the whole components in a single PHP file and submit.”, a single file version also added – in the exchange_rate_api.php - 

To test:
To test the structured version,run: php index.php
if need to test the single file version - exchange_rate_api.php , run: php exchange_rate_api.php
