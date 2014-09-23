<?php

namespace Everlytic;

use GuzzleHttp\Client as GuzzleClient;

class Everlytic
{
    const VERSION = '0.1.0';

    protected $base_url = 'http://everlytic.app/api/2.0';
    protected $username = 'administrator';
    protected $api_key = 'lpm8S7hIcq08NoLfRhvyGu8baSkErKc5';
    protected $headers = array(
        'Content-Type' => 'application/json',
    );
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

    /**
     * @param $url
     * @param $params
     */
    public function post($url, $params)
    {
        return $this->guzzleClient->post($url, array(
            'headers' => $this->headers,
            'body' => $params
        ));
    }

    /**
     * @param $url
     */
    public function get($url)
    {
        return $this->guzzleClient->get($url, array(
            'headers' => $this->headers
        ));
    }

    /**
     * @param $url
     * @param $params
     */
    public function put($url, $params)
    {
        return $this->guzzleClient->put($url, array(
            'headers' => $this->headers,
            'body' => $params
        ));
    }

    /**
     * @param $url
     */
    public function delete($url)
    {
        return $this->guzzleClient->delete($url, array(
            'headers' => $this->headers
        ));
    }

    /**
     * @return GuzzleClient
     */
    public function getClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @param $response
     *
     * @return \GuzzleHttp\Message\Response
     */
    public function returnErrorResponse($response)
    {
        return $response;
    }
}