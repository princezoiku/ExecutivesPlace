<?php

namespace App\Http\Services\Impl;

use App\Http\Services\CurrencyDriver;

class LocalCurrencyDriver extends CurrencyDriver
{

    public function getDriver()
    {
        return 'local';
    }

    public function getRates($currency)
    {
        $config = $this->getConfig();
        return $config['rates'][$currency];
    }
}
