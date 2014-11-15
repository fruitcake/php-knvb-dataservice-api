<?php

namespace KNVB\Dataservice;

use KNVB\Dataservice\Traits\GetDataTrait;

class Competition {
    use GetDataTrait;

    /** @var Club $club */
    protected $club;
    protected $team_id;
    protected $district;
    protected $comp_id;
    protected $class_id;
    protected $poule_id;

    public function __construct(Club $club, $teamId, $district, $compId, $classId, $pouleId)
    {
        $this->club = $club;
        $this->team_id = $teamId;
        $this->district = $district;
        $this->comp_id = $compId;
        $this->class_id = $classId;
        $this->poule_id = $pouleId;
    }
}
