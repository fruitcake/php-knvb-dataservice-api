<?php

namespace KNVB\Dataservice;

use KNVB\Dataservice\Traits\GetDataTrait;

class Team {
    use GetDataTrait;

    /** @var Club $club */
    protected $club;
    protected $id;

    public function __construct(Club $club, $id)
    {
        $this->club = $club;
        $this->id = $id;
    }
}
