<?php

namespace KNVB\Dataservice;


class Schedule extends Match {

	/**
	 * Naam van het veld bij de KNVB
	 * @var string
	 */
	public $VeldKNVB;

	/**
	 * Naam van het veld bij de club
	 * @var string
	 */
	public $VeldClub;

	/**
	 * Kleedkamer voor het thuisteam
	 * @var string
	 */
	public $Kleedkamer_thuis;

	/**
	 * @var Kleedkamer voor het uitteam
	 */
	public $Kleedkamer_uit;

	/**
	 * @var Kleedkamer voor de scheidsrechter
	 */
	public $Kleedkamer_official;
}
