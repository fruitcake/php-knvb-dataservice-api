<?php

namespace KNVB\Dataservice;

class Competition {

    /**
     * Competitie Naam
     * @var string
     */
    public $CompName;

    /**
     * Naam van de klasse
     * @var string
     */
    public $ClassName;

    /**
     * Naam van de poule
     * @var string
     */
    public $PouleName;

    /**
     * District
     * @var string
     */
    public $District;

    /**
     * Competitie ID
     * @var string
     */
    public $CompId;

    /**
     * Class ID
     * @var string
     */
    public $ClassId;

    /**
     * Poule ID
     * @var string
     */
    public $PouleId;

    /**
     * CompType
     * @var string
     */
    public $CompType;

    /** @var Api */
    protected $api;

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}
