<?php
namespace KNVB\Dataservice;

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
    public $ThuisTeamId;

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
    public $UitTeamId;

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
     */
    public $PuntenTeam1;

    /**
     * # doelpunten uit club
     */
    public $PuntenTeam2;

    /**
     * # doelpunten thuis club in verlenging,
     * geeft NULL als er niet is gescoord of er geen verlenging is geweest
     *
     */
    public $PuntenTeam1Verl;

    /**
     * # doelpunten uit club in verlenging,
     * geeft NULL als er niet is gescoord of er geen verlenging is geweest
     *
     */
    public $PuntenTeam2Verl;

    /**
     * # doelpunten thuis club bij strafschoppen,
     * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
     *
     */
    public $PuntenTeam1Strafsch;

    /**
     * # doelpunten thuis club bij strafschoppen,
     * geeft NULL als er niet is gescoord of er geen strafschoppen genomen zijn
     *
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

    public function getId() {
        return $this->MatchID ?: $this->MatchId;
    }
}
