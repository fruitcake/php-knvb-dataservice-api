<?php
namespace KNVB\Dataservice;

class Team extends AbstractItem
{
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

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->teamid;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->teamname;
    }

    /**
     * @param  int|string   $weeknummer week waarvan de uitslagen worden opgehaald (1-52, A) (optioneel)
     * @param  string       $comptype Competitie type R = Regulier, B = Beker, N = Nacompetitie, V = Vriendschappelijke Competitie
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
     * @param  int|string   $weeknummer week waarvan het programma worden opgehaald (1-52, A) (optioneel)
     * @param  string       $comptype Competitie type R = Regulier, B = Beker, N = Nacompetitie, V = Vriendschappelijke Competitie
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
    public function getRanking($comptype = null, $pouleid = null, $periode = null)
    {
        $params = [];
        if($comptype !== null){
            $params['comptype'] = $comptype;
        }
        if($pouleid !== null){
            $params['pouleid'] = $pouleid;
        }
        if($periode !== null){
            $params['periode'] = $periode;
        }
        $response = $this->api->request('teams/'.$this->getId().'/ranking', $params);

        $ranking = array();
        $list = $response['List'];

        // Sometimes this contains multiple rankings, if so, take the first one
        if (isset($list[0]) && isset($list[0]['pouleid'])) {
            $list = $list[0];
            unset($list['pouleid']);
        }

        foreach($list as $item){
            $ranking[] = $this->api->map($item, new Ranking());
        }

        return $ranking;
    }

    /**
     * @param  string   $comptype Van welke competitie type moet de stand worden terug gegeven
     * @return Competition[]
     * @throws InvalidResponseException
     */
    public function getCompetitions($comptype = null)
    {
        $params = [];
        if($comptype !== null){
            $params['comptype'] = $comptype;
        }

        $response = $this->api->request('competities/'.$this->getId(), $params);

        $competitions = array();
        foreach($response['List'] as $item){
            $competition = new Competition($this->api);
            $competition->TeamId = $this->getId();
            $competitions[] = $this->api->map($item, $competition);
        }

        return $competitions;
    }
}
