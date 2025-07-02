<?php

namespace App\ValueObjects;

class CurrencyRate
{
    private float $rate;

    public function __construct(float $rate)
    {
        $this->rate = round($rate, 2); // round to two decimal points
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

?>