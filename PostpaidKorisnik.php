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

        return $ukupnoZaNaplatu;
    }


    public function generisiRacun()
    {
        $racun = "";

        $racun .= "Broj ugovora: " . $this->brojUgovora . ";<br>";
        $racun .= "Korisnik: " . $this->ime . " " . $this->prezime . ";<br>";
        $racun .= "Cena paketa: " . $this->tarifniPaket->cenaPaketa . " rsd;<br>";
        $racun .= "Tarifni dodaci: ";
        foreach ($this->tarifniDodaci as $dodatak)
        {
            $racun .= "- " . $dodatak->tipDodatka . ", cena " . $dodatak->cena . " rsd; ";
        }
        $racun .= "<br>Prekoracenje: " . $this->prekoracenje . " rsd;<br>" ;
        $racun .= "Ukupno za naplatu: " . $this->ukupnoZaNaplatu() . " rsd.<br><br>";

        echo $racun;
        return $racun;
    }


    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        if (in_array($tarifniDodatak, $this->tarifniDodaci))
        {
            echo "Ne mozete dodati. Korisnik vec ima " . $tarifniDodatak->tipDodatka . " tarifni dodatak. <br><br>";
        }
        elseif ($this->tarifniPaket->neogranicenSaobracaj)
        {
            if ($tarifniDodatak->tipDodatka == "IPTV" or $tarifniDodatak->tipDodatka == "Fiksna")
            {
                array_push($this->tarifniDodaci, $tarifniDodatak);
                echo "Uspesno ste dodali " . $tarifniDodatak->tipDodatka . " tarifni dodatak.<br><br>";

            } else
            {
                echo "Ne mozete dodati " . $tarifniDodatak->tipDodatka . " Korisnik ima neograniceni internet! <br><br>";
            }
        }
        elseif (!($this->tarifniPaket->neogranicenSaobracaj))
        {
            array_push($this->tarifniDodaci, $tarifniDodatak);
            echo "Uspesno ste dodali " . $tarifniDodatak->tipDodatka . " tarifni dodatak.<br><br>";
        }
    }


    public function surfuj(string $url, int $mb) : bool
    {

        if ($this->tarifniPaket->neogranicenSaobracaj)
        {
            $this->internetProvajder->zabeleziSaobracaj($this,$url,$mb);
            $listing = new ListingUnos($url, $mb);
            $this->dodajListingUnos($listing);
            echo "Korisnik " . $this->brojUgovora . " je posetio " . $url . " i ima neograniceni internet. <br><br>";
            return true;
        }

        foreach ($this->tarifniDodaci as $dodatak) {
            if (strstr(strtolower($url), strtolower($dodatak->tipDodatka))) {
                $this->internetProvajder->zabeleziSaobracaj($this, $url, $mb);
                $listing = new ListingUnos($url, $mb);
                $this->dodajListingUnos($listing);
                echo "Korisnik " . $this->brojUgovora . " je besplatno posetio " . $url . " jer ima " . $dodatak->tipdodatka . " dodatak. <br><br>";
                return true;
            }
        }

        $this->tarifniPaket->mb -= $mb;
        if ($this->tarifniPaket->mb < 0)
        {
            $this->prekoracenje += (-1 * ($this->tarifniPaket->mb * $this->tarifniPaket->cenaPoMegabajtu));
            $this->tarifniPaket->mb = 0;
            echo "Korisnik " . $this->brojUgovora . " je prekoracio broj Mb, i duguje " . $this->prekoracenje . " rsd.<br><br>";
        }

        $this->internetProvajder->zabeleziSaobracaj($this, $url, $mb);
        $listing = new ListingUnos($url, $mb);
        $this->dodajListingUnos($listing);
        return true;
    }
}



