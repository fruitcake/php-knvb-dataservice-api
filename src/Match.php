<?php
namespace KNVB\Dataservice;

use DateTime;

class Match extends AbstractItem
{
    /**
     * Uniek ID van de wedstrijd
     * @var string
     */
    public $MatchId;

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

    /**
     * # doelpunten thuis club
     * @var int|null
     */
    public $PuntenTeam1;

    /**
     * # doelpunten uit club
     * @var int|null
     */
    public $PuntenTeam2;

    /**
     * # doelpunten thuis club in verlenging,
     * geeft NULL als er niet is gescoord of er geen verlenging is geweest
     * @var string|null
     */
    public $PuntenTeam1Verl;

    /**
     * # doelpunten uit club in verlenging,
     * geeft NULL als er niet is gescoord of er geen verlenging is geweest
     * @var string|null
     */
    public $PuntenTeam2Verl;

    /**
     * # doelpunten thuis club bij strafschoppen,
     * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
     * @var string|null
     */
    public $PuntenTeam1Strafsch;

    /**
     * # doelpunten thuis club bij strafschoppen,
     * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
     * @var string|null
     */
    public $PuntenTeam2Strafsch;

    /**
     * Naam van de scheidsrechter
     * @var string
     */
    public $Scheidsrechter;

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
     * Kleedkamer voor het uitteam
     * @var string
     */
    public $Kleedkamer_uit;

    /**
     * Kleedkamer voor de scheidsrechter
     * @var string
     */
    public $Kleedkamer_official;

    /**
     * Club KNVB nummer.
     * @var string
     */
    public $Facility_Id;

    /**
     * Naam van het sportpark
     * @var string
     */
    public $Facility_naam;

    /**
     * De stand van het sportpark
     * @var string
     */
    public $Facility_Stad;

    /**
     * De postcode van het sportpark
     * @var string
     */
    public $Facility_Postcode;

    /**
     * De adres van het sportpark
     * @var string
     */
    public $Facility_Adres;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->MatchID ?: $this->MatchId;
    }

    /**
     * De datum + tijd als DateTime object
     *
     * @return DateTime
     */
    public function getDateTime()
    {
        //Date is in Y-m-d, time is saved as a string formatted like: 1830.
        return DateTime::createFromFormat('Y-m-d Hi', $this->Datum . ' ' . $this->Tijd);
    }
}
