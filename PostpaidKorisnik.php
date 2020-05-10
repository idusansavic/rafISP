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
     * @param array $listaListingUnosa
     */
    public function __construct(float $prekoracenje, InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket, array $tarifniDodaci, array $listaListingUnosa)
    {
        parent::__construct($internetProvajder, $ime, $prezime, $adresa, $brojUgovora, $tarifniPaket, $tarifniDodaci, $listaListingUnosa);
        $this->prekoracenje = $prekoracenje;
    }


    public function ukupnoZaNaplatu()
    {
        $ukupnoZaNaplatu = ($this->tarifniPaket->cenaPaketa) + $this->prekoracenje;

        foreach ($this->tarifniDodaci as $dodatak)
        {
            $ukupnoZaNaplatu += $dodatak->cena;
        }

        echo  "Ukupno za naplatu: " . $ukupnoZaNaplatu . " rsd;";
        echo "<br>";
        echo "<br>";

    }

    public function generisiRacun() //URADITI STRING CONCATENATION
    {

       echo "Broj ugovora: " . $this->brojUgovora . ";";
       echo "<br>";
       echo "Korisnik: " . $this->ime . " " . $this->prezime . ";";
       echo "<br>";
       echo "Cena paketa: " . $this->tarifniPaket->cenaPaketa . " rsd;";
       echo "<br>";
       echo "Tarifni dodaci: ";
        foreach ($this->tarifniDodaci as $dodatak)
        {
            echo "- " . $dodatak->tipDodatka . ", cena " . $dodatak->cena . " rsd; ";
        }
       echo "<br>";
       echo "Prekoracenje: " . $this->prekoracenje . " rsd;";
       echo "<br>";
       $this->ukupnoZaNaplatu();

    }

    public function surfuj(string $url, int $mb) : bool
    {
        return true;
        // TODO: Implement surfuj() method.
    }

    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        if (in_array($tarifniDodatak, $this->tarifniDodaci))
        {
            echo "Ne mozete dodati. Korisnik vec ima " . $tarifniDodatak->tipDodatka . " tarifni dodatak.";
            echo "<br>";
            echo "<br>";
        }
        elseif ($this->tarifniPaket->neogranicenSaobracaj == true)
        {
            if ($tarifniDodatak->tipDodatka == "IPTV" or $tarifniDodatak->tipDodatka == "Fiksna")
            {
                array_push($this->tarifniDodaci, $tarifniDodatak);
                echo "Uspesno ste dodali " . $tarifniDodatak->tipDodatka . " tarifni dodatak.";
                echo "<br>";
                echo "<br>";

            } else
            {
                echo "Ne mozete dodati " . $tarifniDodatak->tipDodatka . " tarifni dodatak POSTPAID korisniku!";
                echo "<br>";
                echo "<br>";

            }
        }
    }
}



