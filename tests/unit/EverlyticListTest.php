<?php

use Everlytic\Api\EverlyticList;

class EverlyticListTest extends ApiTester
{
    public function tearDown()
    {
        parent::tearDown();
    }

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

    public function testGetList_WithIdentifier_ReturnsListObject()
    {
        $fakeList = $this->makeFakeList();

        $list = $this->withSuccessResponse($fakeList)->make(new EverlyticList());

        $response = $list->getList($fakeList['list_id']);

        $this->assertResponseOk($response->getStatusCode());
        $this->assertEquals($fakeList, $response->json());
    }


    public function testGetList_WithoutRequiredParameters_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->getList(null);

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    public function testGetList_WithIdentifier_ReturnsListObjectNotFoundResponse()
    {
        $list = $this->withNotFoundResponse()->make(new EverlyticList());

        $response = $list->getList(999);

        $this->assertResponseCode(404, $response->getStatusCode());
    }

    public function testGetLists_ReturnsListsObjects()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->getLists();

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testUpdateList_WithIdentifierAndParams_ReturnsOkResult()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->updateList(1, $this->makeFakeListProperties());

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testUpdateList_WithoutRequiredParameters_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->updateList(null, $this->makeFakeListProperties());

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    public function testUpdateList_WithIdentifier_ReturnsListObjectNotFoundResponse()
    {
        $list = $this->withNotFoundResponse()->make(new EverlyticList());

        $response = $list->updateList(999, $this->makeFakeListProperties());

        $this->assertResponseCode(404, $response->getStatusCode());
    }

    public function testDeleteList_WithIdentifier_ReturnsOkResult()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->deleteList(1);

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testDeleteList_WithoutRequiredParameters_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->deleteList(null);

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    public function testDeleteList_WithIdentifier_ReturnsListObjectNotFoundResponse()
    {
        $list = $this->withNotFoundResponse()->make(new EverlyticList());

        $response = $list->deleteList(999);

        $this->assertResponseCode(404, $response->getStatusCode());
    }

    public function testEmptyList_WithIdentifier_ReturnsOkResult()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->emptyList(1);

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testEmptyList_WithoutRequiredParameters_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->emptyList(null);

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    public function testEmptyList_WithIdentifier_ReturnsListObjectNotFoundResponse()
    {
        $list = $this->withNotFoundResponse()->make(new EverlyticList());

        $response = $list->emptyList(999);

        $this->assertResponseCode(404, $response->getStatusCode());
    }

    public function testMergeLists_WithIdentifiers_ReturnsOkResult()
    {
        $list = $this->withSuccessResponse()->make(new EverlyticList());

        $response = $list->mergeLists(1, 2);

        $this->assertResponseOk($response->getStatusCode());
    }

    public function testMergeLists_WithoutRequiredParameters_ReturnsBadRequest()
    {
        $list = $this->withBadRequestResponse()->make(new EverlyticList());

        $response = $list->mergeLists(null, null);

        $this->assertResponseCode(400, $response->getStatusCode());
    }

    public function testMergeLists_WithIdentifier_ReturnsListObjectNotFoundResponse()
    {
        $list = $this->withNotFoundResponse()->make(new EverlyticList());

        $response = $list->mergeLists(998, 999);

        $this->assertResponseCode(404, $response->getStatusCode());
    }

    private function makeFakeList()
    {
        return [
            'list_id' => $this->fake->randomNumber(),
            'list_name' => $this->fake->sentence(2),
            'list_owner_email' => $this->fake->email,
        ];
    }

    private function makeFakeListProperties()
    {
        return [
            'list_public_name' => $this->fake->sentence(2),
            'list_owner_email' => $this->fake->email,
        ];
    }
}

 