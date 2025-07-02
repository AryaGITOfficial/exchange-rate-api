<?php
require 'vendor/autoload.php';

use App\Services\GetUSDExchangeRateService;

$service = new GetUSDExchangeRateService();

echo "Value from MoneyNow: " . $service('moneynow') . PHP_EOL;
echo "Value from FinanceMagic: " . $service('financemagic') . PHP_EOL;

// echo "test";

?>