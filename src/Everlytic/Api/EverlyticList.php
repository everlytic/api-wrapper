<?php

namespace Everlytic\Api;

use Everlytic\Everlytic;
use GuzzleHttp\Exception\ClientException;

class EverlyticList extends Everlytic
{
    /**
     * @param array $params
     */
    public function createList($params = array())
    {
        try {
            return $this->post('/lists', $params);
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    /**
     * @param $id
     */
    public function getList($id)
    {
        try {
            return $this->get('/lists/' . $id);
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    public function getLists()
    {
        try {
            return $this->get('/lists');
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    /**
     * @param $id
     * @param array $params
     */
    public function updateList($id, $params = array())
    {
        try {
            return $this->put('/lists/' . $id, $params);
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    /**
     * @param $id
     */
    public function deleteList($id)
    {
        try {
            return $this->delete('/lists/' . $id);
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    /**
     * @param $id
     */
    public function emptyList($id)
    {
        try {
            return $this->post('/list_actions/empty/' . $id, array());
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }

    /**
     * @param $from_id
     * @param $to_id
     */
    public function mergeLists($from_id, $to_id)
    {
        try {
            return $this->post('/list_actions/merge/' . $from_id . '/' . $to_id, array());
        } catch (ClientException $e) {
            return $this->returnErrorResponse($e->getResponse());
        }
    }
}

 