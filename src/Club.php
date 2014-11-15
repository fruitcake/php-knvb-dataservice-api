<?php

namespace KNVB\Dataservice;

use KNVB\Dataservice\Exception\InvalidResponseException;
use KNVB\Dataservice\Exception\MissingAttributeException;
use KNVB\Dataservice\HttpClient\HttpClient;
use KNVB\Dataservice\HttpClient\HttpClientInterface;
use KNVB\Dataservice\Traits\GetDataTrait;

class Club {
    use GetDataTrait;

    /** @var HttpClientInterface $client  */
    protected $client;

    protected $pathname;
    protected $key;
    protected $apiversion;

    protected $teams;

    public function __construct($pathname, $key, $apiversion = '2.0')
    {
        $this->pathname = $pathname;
        $this->key = $key;
        $this->apiversion = $apiversion;
    }

    /**
     * Make a request to the API
     *
     * @param $path
     * @param array $parameters
     * @throws InvalidResponseException
     * @return array
     */
    public function request($path, $parameters = [])
    {
        $data = $this->getClient()->get($path, $parameters);

        if (!isset($data['errorcode']) || $data['errorcode'] !== 1000 || !isset($data['List'])) {
            throw new InvalidResponseException($data['message'], $data['errorcode']);
        }

        return $data;
    }

    /**
     * Initialize the session and authenticate this club
     *
     * @throws InvalidResponseException
     */
    public function initialize()
    {
        $response = $this->request('initialisatie/'.$this->pathname, ['apiversion' => $this->apiversion]);

        if (isset($response['List']) && isset($response['List'][0])) {
            $this->setData($response['List'][0]);
            $this->apiversion = $this->get('apiversion');
            $this->getClient()->authenticate($this->getSessionId(), $this->key);
            return;
        }

        throw new InvalidResponseException($response['message'], $response['errorcode']);
    }

    /**
     * Return the HttpClient
     *
     * @return HttpClientInterface
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new HttpClient();
        }
        return $this->client;
    }

    /**
     * Create a new Client instance. If the HttpClient is not set,
     * the default HttpClient will be used.
     *
     * @param HttpClientInterface $client
     */
    public function setClient(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getSessionId()
    {
        return $this->get('PHPSESSID');
    }

    public function getName(){
        return $this->get('clubnaam');
    }

    public function getLogo(){
        return $this->get('logo');
    }

    public function getTeams()
    {
        if ($this->teams) {
            return $this->teams;
        }

        $response = $this->request('teams');

        $this->teams = array();
        foreach($response['List'] as $item){
            $id = $item['teamid'];
            $team = new Team($this, $id);
            $team->setData($item);
            $this->teams[$id] = $team;
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
