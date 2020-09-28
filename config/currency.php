<?php

return [

    'default' => 'local', //possible values are local, external

    'drivers' => [
        'local' => [
            "rates" => [
                "USD" => [
                    "EUR" => 0.8,
                    "USD" => 1.0,
                    "GBP" => 0.7,
                ],
                "GBP" => [
                    "EUR" => 1.1,
                    "USD" => 1.3,
                    "GBP" => 1.0,
                ],
                "EUR" => [
                    "EUR" => 1.0,
                    "USD" => 1.2,
                    "GBP" => 0.9,
                ],
            ]

        ],
        'external' => [
            'endpoint' => 'https://api.exchangeratesapi.io/'
        ]
    ]

];
