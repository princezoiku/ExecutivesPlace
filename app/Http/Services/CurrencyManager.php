<?php

namespace App\Http\Services;

use App\Http\Services\Impl\ExternalCurrencyDriver;
use App\Http\Services\Impl\LocalCurrencyDriver;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class CurrencyManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config->get('currency.default');
    }

    public function createLocalDriver()
    {
        return new LocalCurrencyDriver();
    }

    public function createExternalDriver()
    {
        return new ExternalCurrencyDriver();
    }
}
