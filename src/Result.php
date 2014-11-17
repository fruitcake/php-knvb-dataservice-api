<?php

namespace KNVB\Dataservice;


class Ranking extends Match {

	/**
	 * # doelpunten thuis club
	 * @var int
	 */
	public $PuntenTeam1;

	/**
	 * # doelpunten uit club
	 * @var int
	 */
	public $PuntenTeam2;

	/**
	 * # doelpunten thuis club in verlenging,
	 * geeft NULL als er niet is gescoord of er geen verlenging is geweest
	 *
	 * @var int|null
	 */
	public $PuntenTeam1Verl;

	/**
	 * # doelpunten uit club in verlenging,
	 * geeft NULL als er niet is gescoord of er geen verlenging is geweest
	 *
	 * @var int|null
	 */
	public $PuntenTeam2Verl;

	/**
	 * # doelpunten thuis club bij strafschoppen,
	 * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
	 *
	 * @var int|null
	 */
	public $PuntenTeam1Strafsch;

	/**
	 * # doelpunten thuis club bij strafschoppen,
	 * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
	 *
	 * @var int|null
	 */
	public $PuntenTeam2Strafsch;

	/**
	 * Naam van de scheidsrechter
	 * @var string
	 */
	public $Scheidsrechter;

}
