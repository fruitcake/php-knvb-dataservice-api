<?php

namespace KNVB\Dataservice;

use KNVB\Dataservice\Traits\GetDataTrait;

class Match {
    use GetDataTrait;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
