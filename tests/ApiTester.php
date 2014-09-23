<?php

use Faker\Factory as Faker;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

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

    public function assertResponseOk($code)
    {
        $this->assertEquals(200, $code);
    }

    public function assertResponseCode($expected_code, $code)
    {
        $this->assertEquals($expected_code, $code);
    }

    public function make($wrapper)
    {
        $wrapper->getClient()->getEmitter()->attach($this->mockResponse);

        return $wrapper;
    }

    protected function withSuccessResponse($body = null)
    {
        $this->getMockWithCode(200, $body);

        return $this;
    }

    protected function withBadRequestResponse()
    {
        $this->getMockWithCode(400);

        return $this;
    }

    protected function withNotFoundResponse()
    {
        $this->getMockWithCode(404);

        return $this;
    }

    private function getMockWithCode($code, $body = null)
    {
        $response = new Response($code, array());

        if (isset($body) === true) {
            $response->setBody(Stream::factory(json_encode($body)));
        }

        $this->mockResponse = new Mock(
            array($response)
        );
    }
} 