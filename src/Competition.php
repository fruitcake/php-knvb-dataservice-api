<?php
namespace KNVB\Dataservice;

class Competition extends AbstractItem
{
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

    /**
     * TeamId
     * @var string
     */
    public $TeamId;

    /**
     * TeamAanduiding
     * @var string
     */
    public $TeamAanduiding;

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
    public function getName()
    {
        return $this->CompName;
    }

    /**
     * @param  int|string   $weeknummer week waarvan de uitslagen worden opgehaald (1-52, A) (optioneel)
     * @return Match[]
     * @throws InvalidResponseException
     */
    public function getResults($weeknummer = null)
    {
        $params = [];
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }

        $response = $this->api->request(
            'competities/'.$this->TeamId.'/'.$this->District.'/'.$this->CompId.'/'.$this->ClassId.'/'.$this->PouleId.'/results',
            $params
        );

        $matches = array();
        foreach($response['List'] as $item){
            $matches[] = $this->api->map($item, new Match());
        }

        return $matches;
    }

    /**
     * @param  int|string   $weeknummer week waarvan het programma worden opgehaald (1-52, A) (optioneel)
     * @return Match[]
     * @throws InvalidResponseException
     */
    public function getSchedule($weeknummer = null)
    {
        $params = [];
        if($weeknummer !== null){
            $params['weeknummer'] = $weeknummer;
        }

        $response = $this->api->request(
            'competities/'.$this->TeamId.'/'.$this->District.'/'.$this->CompId.'/'.$this->ClassId.'/'.$this->PouleId.'/schedule',
            $params
        );

        $matches = array();
        foreach($response['List'] as $item){
            $matches[] = $this->api->map($item, new Match());
        }

        return $matches;
    }

    /**
     * @return Ranking[]
     * @throws InvalidResponseException
     */
    public function getRanking()
    {
        $response = $this->api->request(
            'competities/'.$this->TeamId.'/'.$this->District.'/'.$this->CompId.'/'.$this->ClassId.'/'.$this->PouleId.'/ranking'
        );

        $ranking = array();
        foreach($response['List'] as $item){
            $ranking[] = $this->api->map($item, new Ranking());
        }

        return $ranking;
    }
}
