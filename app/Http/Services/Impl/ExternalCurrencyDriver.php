<?php

namespace App\Http\Services\Impl;

use App\Http\Services\CurrencyDriver;
use GuzzleHttp\Client;

class ExternalCurrencyDriver extends CurrencyDriver
{
    public function getDriver()
    {
        return 'external';
    }

    public function getRates($currency)
    {
        $config = $this->getConfig();
        $endpoint = $config['endpoint'];

        //Call external endpoint to fetch the rates
        $client = new Client(['base_uri' => $endpoint]);
        $response = $client->request('GET', 'latest');

        $body = json_decode($response->getBody()->getContents(), true);
        return $body['rates'];
    }
}
