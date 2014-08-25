<?php

namespace Everlytic\Api;

use Everlytic\Everlytic;

class EverlyticList extends Everlytic
{
    public function createList($params = array())
    {
        return $this->post('/lists', $params);
    }
}

 