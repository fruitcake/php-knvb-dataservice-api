<?php
namespace KNVB\Dataservice;

class Ranking extends AbstractItem
{
    /**
     * @var string
     */
    public $naam;

    /**
     * @var string
     */
    public $TeamID;

    /**
     * @var string
     */
    public $logo;

    /**
     * @var int
     */
    public $Positie;

    /**
     * @var int
     */
    public $Punten;

    /**
     * @var int
     */
    public $Gespeeld;

    /**
     * @var int
     */
    public $Gewonnen;

    /**
     * @var int
     */
    public $Gelijk;

    /**
     * @var int
     */
    public $Verloren;

    /**
     * @var int
     */
    public $DoelpuntenVoor;

    /**
     * @var int
     */
    public $DoelpuntenTegen;

    /**
     * @var int
     */
    public $PuntenMindering;

    /**
     * @var string
     */
    public $CompType;

    /**
     * @var string
     */
    public $CompNummer;

    /**
     * @var string
     */
    public $WedstrijdDag;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->TeamID;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->naam;
    }
}
