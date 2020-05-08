<?php

require_once "requireList.php";

abstract class Korisnik implements IzradaListinga
{
    public InternetProvajder $internetProvajder;
    public string $ime;
    public string $prezime;
    public string $adresa;
    public int $brojUgovora;
    public TarifniPaket $tarifniPaket;
    public array $tarifniDodaci = [];

    /**
     * Korisnik constructor.
     * @param InternetProvajder $internetProvajder
     * @param string $ime
     * @param string $prezime
     * @param string $adresa
     * @param int $brojUgovora
     * @param TarifniPaket $tarifniPaket
     */
    public function __construct(InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket)
    {
        $this->internetProvajder = $internetProvajder;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->adresa = $adresa;
        $this->brojUgovora = $brojUgovora;
        $this->tarifniPaket = $tarifniPaket;
    }


    public function dodajListingUnos(ListingUnos $listingUnos)
    {

    }

    public function napraviListing() : string
    {

    }

    abstract function surfuj(string $url, int $mb) : bool;

    abstract function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak);



}