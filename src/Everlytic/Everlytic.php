<?php

namespace Everlytic;

use GuzzleHttp\Client as GuzzleClient;

class Everlytic
{
    const VERSION = '0.1.0';

    protected $base_url = 'http://everlytic.app/api/2.0';

    protected $username = 'administrator';

    protected $api_key = 'lpm8S7hIcq08NoLfRhvyGu8baSkErKc5';

    protected $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new GuzzleClient(array(
            'base_url' => $this->base_url,
            'defaults' => array(
                'auth' => array($this->username, $this->api_key)
            )
        ));
    }

    public function post($url, $params)
    {
        return $this->guzzleClient->post($url, array(
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => $params
        ));
    }

    public function getClient()
    {
        return $this->guzzleClient;
    }
}