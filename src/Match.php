<?php

namespace KNVB\Dataservice;

class Match {

    /**
     * Uniek ID van de wedstrijd
     * @var string
     */
    public $MatchID;

    /**
     * Nummer van de wedstrijd dat door de KNVB gebruikt wordt op het wedstrijdformulier
     * @var string
     */
    public $WedstrijdNummer;

    /**
     * Datum van wedstrijd in YYYY-MM-DD formaat
     *
     * @var string
     */
    public $Datum;

    /**
     * Tijd van wedstrijd in HHMM formaat
     * @var string
     */
    public $Tijd;

    /**
     * Naam van team bestaande uit Club TeamAanduiding
     * @var string
     */
    public $ThuisClub;

    /**
     * URL van logo van thuisclub
     * @var string
     */
    public $ThuisLogo;

    /**
     * Uniek ID van thuis team
     * @var string
     */
    public $ThuisTeamID;

    /**
     * Naam van team bestaande uit Club TeamAanduiding
     * @var string
     */
    public $UitClub;

    /**
     * URL van logo van uitclub
     * @var string
     */
    public $UitLogo;

    /**
     * Uniek ID van het uit-team
     * @var string
     */
    public $UitTeamID;

    /**
     * Wedstrijd status
     * @var string
     */
    public $Bijzonderheden;

    /**
     * Competitie Type (R, B, N of V)
     * @var string
     */
    public $CompType;

    /**
     * Competitie Nummer
     * @var string
     */
    public $CompNummer;

    /**
     * Wedstrijddag
     * @var int
     */
    public $WedstrijdDag;
}
