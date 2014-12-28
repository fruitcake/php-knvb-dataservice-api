<?php
namespace KNVB\Dataservice;

class Club extends AbstractItem
{

    /**
     * Session ID
     * @var string
     */
    public $PHPSESSID;

    /**
     * Versie van de API
     * @var string
     */
    public $apiversion;

    /**
     * URL van changelog waar aanwezige versie
     * van de API kunnen worden gecontroleerd.
     *
     * @var string
     */
    public $changelog;

    /**
     * URL van clublogo
     * @var string
     */
    public $logo;

    /**
     * Volledige naam van club
     * @var string
     */
    public $clubnaam;

    /**
     * Sponsor van de club app
     * @var array
     */
    public $appsponsors;

    /**
     * RSS feed(s) van club
     * @var array
     */
    public $rss;

    /**
     * Twitter account voor club
     * @var string
     */
    public $twitter;

    /**
     * Keywords voor club op Twitter
     * @var string
     */
    public $twittertags;

    /**
     * @var array
     */
    public $kleuren;

    /** @var Api */
    protected $api;
    protected $teams = [];

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
    public function getName()
    {
        return $this->clubnaam;
    }

    /**
     * @return Team[]
     * @throws InvalidResponseException
     */
    public function getTeams()
    {
        if ($this->teams) {
            return $this->teams;
        }

        $response = $this->api->request('teams');

        $this->teams = array();
        foreach($response['List'] as $item){
            // Convert "J" / "N" to true/false
            foreach(['regulierecompetitie', 'bekercompetitie', 'nacompetitie'] as $key){
                $item[$key] = $item[$key] == "J";
            }

            /** @var Team $team */
            $team = $this->api->map($item, new Team($this->api));
            $this->teams[$team->teamid] = $team;
        }

        return  $this->teams;
    }

    /**
     * @param  string $id
     * @throws MissingAttributeException
     * @return Team
     */
    public function getTeam($id)
    {
        $teams = $this->getTeams();

        if (isset($teams[$id])) {
            return $teams[$id];
        }

        throw new MissingAttributeException("Team $id is not available");
    }

    /**
     * Met deze call kan een listing van wedstrijden van de hele club worden opgehaald.
     * 
     * @param string|int $weeknummer
     * @param string $comptype
     * @param string $zaalveld
     * @param string $order
     * @return Match[]
     * @see http://api.knvbdataservice.nl/v2/wedstrijden
     */
    public function getMatches($weeknummer = null, $comptype = null, $zaalveld = null, $order = null)
    {
        $params = [];
        if($comptype !== null){
            $params['comptype'] = $comptype;
        }
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }
        if($zaalveld !== null){
            $params['zaalveld'] = $zaalveld;
        }
        if($order !== null){
            $params['order'] = $order;
        }

        $response = $this->api->request('wedstrijden', $params);

        $matches = array();
        foreach($response['List'] as $item){
            $matches[] = $this->api->map($item, new Match());
        }

        return $matches;
    }

    /**
     * @param  string $id
     * @return Match
     */
    public function getMatch($id)
    {
        $response = $this->api->request('wedstrijd/'.$id);
        return $this->api->map($response['List'][0], new Match($this->api));
    }

    /**
     * @return Competition[]
     * @throws InvalidResponseException
     */
    public function getCompetitions()
    {
        $response = $this->api->request('competities');

        $competitions = array();
        foreach($response['List'] as $item){
            $competitions[] = $this->api->map($item, new Competition($this->api));
        }

        return $competitions;
    }

    /**
     * @return Banner
     */
    public function getBanner()
    {
        $response = $this->api->request('banners');

        return $this->api->map($response['List'], new Banner);
    }

}
