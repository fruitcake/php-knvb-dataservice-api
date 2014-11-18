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
     * @param  string       $comptype Competitie type R = Regulier, B = Beker, N = Nacompetitie, V = Vriendschappelijke Competitie
     * @param  int|string   $weeknummer week waarvan de uitslagen worden opgehaald (1-52, A) (optioneel)
     * @return Match[]
     * @throws InvalidResponseException
     */
    public function getResults($weeknummer = null, $comptype = null)
    {
        $params = [];
        if($comptype !== null){
            $params['comptype'] = $comptype;
        }
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }
        $response = $this->api->request('teams/'.$this->getId().'/results', $params);

        $matches = array();
        foreach($response['List'] as $item){
            $matches[] = $this->api->map($item, new Match());
        }

        return $matches;
    }

    /**
     * @param  string       $comptype Competitie type R = Regulier, B = Beker, N = Nacompetitie, V = Vriendschappelijke Competitie
     * @param  int|string   $weeknummer week waarvan het programma worden opgehaald (1-52, A) (optioneel)
     * @return Match[]
     * @throws InvalidResponseException
     */
    public function getSchedule($weeknummer = null, $comptype = null)
    {
        $params = [];
        if($comptype !== null){
            $params['comptype'] = $comptype;
        }
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }
        $response = $this->api->request('teams/'.$this->getId().'/schedule', $params);

        $matches = array();
        foreach($response['List'] as $item){
            $matches[] = $this->api->map($item, new Match());
        }

        return $matches;
    }

    /**
     * @param  string   $comptype Van welke competitie type moet de stand worden terug gegeven
     * @param  string   $pouleid ('all' for all poules')
     * @param  int      $periode Om de stand per periode terug te geven (1-4, optioneel)
     * @return Ranking[]
     * @throws InvalidResponseException
     */
    public function getRanking($comptype = 'R', $pouleid = null, $periode = null)
    {
        $params = [
            'comptype' => $comptype,
        ];
        if($pouleid !== null){
            $params['pouleid'] = $pouleid;
        }
        if($periode !== null){
            $params['periode'] = $periode;
        }
        $response = $this->api->request('teams/'.$this->getId().'/ranking', $params);

        $ranking = array();
        foreach($response['List'] as $item){
            $ranking[] = $this->api->map($item, new Ranking());
        }

        return $ranking;
    }
}
