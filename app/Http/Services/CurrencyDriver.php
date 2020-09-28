<?php

namespace App\Http\Services;

abstract class CurrencyDriver
{

    public function getConfig()
    {
        return config('currency.drivers.' . $this->getDriver());
    }

    public abstract function getDriver();

    public abstract function getRates($currency);
}
