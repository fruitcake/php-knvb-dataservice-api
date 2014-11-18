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
     * @var bool
     */
    public $regulierecompetitie;

    /**
     * @var bool
     */
    public $bekercompetitie;

    /**
     * @var bool
     */
    public $nacompetitie;


    /** @var Api */
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getId()
    {
        return $this->teamid;
    }

    public function getName()
    {
        return $this->teamname;
    }

    /**
     * @return Result[]
     * @throws InvalidResponseException
     */
    public function getResults($comptype = 'R', $weeknummer = null)
    {
        $params = [
            'comptype' => $comptype,
        ];
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }
        $response = $this->api->request('teams/'.$this->getId().'/results', $params);

        $results = array();
        foreach($response['List'] as $item){
            $results[] = $this->api->map($item, new Result());
        }

        return $results;
    }

    /**
     * @return Schedule[]
     * @throws InvalidResponseException
     */
    public function getSchedule($comptype = 'R', $weeknummer = null)
    {
        $params = [
            'comptype' => $comptype,
        ];
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }
        $response = $this->api->request('teams/'.$this->getId().'/schedule', $params);

        $schedule = array();
        foreach($response['List'] as $item){
            $schedule[] = $this->api->map($item, new Schedule());
        }

        return $schedule;
    }
}
