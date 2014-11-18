<?php
namespace KNVB\Dataservice;

class Ranking extends AbstractItem
{
    public $naam;
	public $TeamID;
	public $logo;
	public $Positie;
	public $Punten;
    public $Gespeeld;
	public $Gewonnen;
	public $Gelijk;
	public $Verloren;
    public $DoelpuntenVoor;
	public $DoelpuntenTegen;
	public $PuntenMindering;
    public $CompType;
	public $CompNummer;
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
