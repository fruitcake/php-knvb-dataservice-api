<?php

namespace KNVB\Dataservice;

class Team {

    /**
     * @var string
     */
    public $teamid;

    /**
     * @var string
     */
    public $teamname;

    /**
     * @var string
     */
    public $speeldag;

    /**
     * @var string
     */
    public $categorie;

    /**
     * @var string
     */
    public $reguliercompetitie;

    /**
     * @var string
     */
    public $bekercompetitie;

    /**
     * @var string
     */
    public $nacompetitie;


    /** @var Api */
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}
