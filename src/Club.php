<?php

namespace KNVB\Dataservice;

class Club {

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

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
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
            /** @var Team $team */
            $team = $this->api->map($item, new Team($this->api));
            $this->teams[$team->teamid] = $team;
        }

        return  $this->teams;
    }

    public function getTeam($id)
    {
        $teams = $this->getTeams();

        if (isset($teams[$id])) {
            return $teams[$id];
        }

        throw new MissingAttributeException("Team $id is not available");
    }


}
