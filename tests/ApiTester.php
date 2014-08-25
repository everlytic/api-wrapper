<?php

use Faker\Factory as Faker;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;

abstract class ApiTester extends \PHPUnit_Framework_TestCase
{
    protected $fake;
    protected $wrapper;
    protected $mockResponse;

    public function __construct()
    {
        $this->fake = Faker::create();
    }

    public function tearDown()
    {
        $this->wrapper = null;
        $this->mockResponse = null;
    }

    public function assertResponseOk($response_code)
    {
        $this->assertEquals(200, $response_code);
    }

    public function assertResponseCode($expected_code, $response_code)
    {
        $this->assertEquals($expected_code, $response_code);
    }

    public function make($wrapper)
    {
        $wrapper->getClient()->getEmitter()->attach($this->mockResponse);

        return $wrapper;
    }

    protected function withSuccessResponse()
    {
        $this->getMockWithCode(200);

        return $this;
    }

    protected function withBadRequestResponse()
    {
        $this->getMockWithCode(400);

        return $this;
    }

    private function getMockWithCode($code)
    {
        $this->mockResponse = new Mock(array(
            new Response($code, array())
        ));
    }
} 