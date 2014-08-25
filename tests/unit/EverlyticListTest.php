<?php

use Everlytic\Api\EverlyticList;

class EverlyticListTest extends ApiTester
{
    public function testCreateList_WithParams_ReturnsOkResultAndListObject()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->createList($this->makeFakeList());

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testCreateList_WithoutRequiredFields_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->createList(array());

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    private function makeFakeList()
    {
        return [
            'list_name' => $this->fake->sentence(2),
            'list_owner_email' => $this->fake->email,
        ];
    }
}

 