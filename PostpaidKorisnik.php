<?php

require_once "Korisnik.php";
require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "TarifniDodatak.php";

class PostpaidKorisnik extends Korisnik
{
    public float $prekoracenje;

    /**
     * PrepaidKorisnik constructor.
     * @param float $prekoracenje
     * @param InternetProvajder $internetProvajder
     * @param string $ime
     * @param string $prezime
     * @param string $adresa
     * @param int $brojUgovora
     * @param TarifniPaket $tarifniPaket
     * @param array $tarifniDodaci
     */
    public function __construct(float $prekoracenje, InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket, array $tarifniDodaci)
    {
        parent::__construct($internetProvajder, $ime, $prezime, $adresa, $brojUgovora, $tarifniPaket, $tarifniDodaci);
        $this->prekoracenje = $prekoracenje;
    }


    public function ukupnoZaNaplatu()
    {

    }

    public function generisiRacun()
    {

    }

    public function surfuj(string $url, int $mb): bool
    {
        return true;
        // TODO: Implement surfuj() method.
    }

    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        // TODO: Implement dodajTarifniDodatak() method.
    }
}



