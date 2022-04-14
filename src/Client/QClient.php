<?php

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class QClient
{

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function login()
    {

    }

}