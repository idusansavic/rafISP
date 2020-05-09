<?php

require_once "Korisnik.php";
require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "TarifniDodatak.php";

class PrepaidKorisnik extends Korisnik
{
    public float $kredit;

    /**
     * PrepaidKorisnik constructor.
     * @param float $kredit
     * @param InternetProvajder $internetProvajder
     * @param string $ime
     * @param string $prezime
     * @param string $adresa
     * @param int $brojUgovora
     * @param TarifniPaket $tarifniPaket
     * @param array $tarifniDodaci
     */
    public function __construct(float $kredit, InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket, array $tarifniDodaci)
    {
        parent::__construct($internetProvajder, $ime, $prezime, $adresa, $brojUgovora, $tarifniPaket, $tarifniDodaci);
        $this->kredit = $kredit;
    }



    public function dopuniKredit(float $kredit)
    {

    }

    public function surfuj(string $url, int $mb): bool
    {
        // TODO: Implement surfuj() method.
    }

    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        // TODO: Implement dodajTarifniDodatak() method.
    }

}

