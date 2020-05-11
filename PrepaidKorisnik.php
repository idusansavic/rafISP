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
     * @param array $listaListingUnosa
     */
    public function __construct(float $kredit, InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket, array $tarifniDodaci, array $listaListingUnosa)
    {
        parent::__construct($internetProvajder, $ime, $prezime, $adresa, $brojUgovora, $tarifniPaket, $tarifniDodaci, $listaListingUnosa);
        $this->kredit = $kredit;
    }


    public function dopuniKredit(float $kredit)
    {
        $this->kredit += $kredit;
        echo "Uspesno ste dopunili kredit, trenutno imate " . $this->kredit . " kredita <br><br>";

    }


    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        if (in_array($tarifniDodatak, $this->tarifniDodaci))
        {
            echo "Ne mozete dodati. Korisnik vec ima " . $tarifniDodatak->tipDodatka . " tarifni dodatak. <br><br>";
        }
        elseif ($this instanceof PrepaidKorisnik)
        {
            if ($tarifniDodatak->tipDodatka == "IPTV" or $tarifniDodatak->tipDodatka == "Fiksna")
            {
                echo "Ne mozete dodati " . $tarifniDodatak->tipDodatka . " tarifni dodatak PREPAID korisniku! <br><br>";

            } else
            {
                array_push($this->tarifniDodaci, $tarifniDodatak);
                echo "Uspesno ste dodali " . $tarifniDodatak->tipDodatka . " tarifni dodatak. <br><br>";
            }
        }
    }


    public function surfuj(string $url, int $mb) : bool
    {
        foreach ($this->tarifniDodaci as $dodatak) {
            if (strstr(strtolower($url), strtolower($dodatak->tipDodatka)))  {
                $this->internetProvajder->zabeleziSaobracaj($this, $url, $mb);
                $listing = new ListingUnos($url, $mb);
                $this->dodajListingUnos($listing);
                echo "Korisnik " . $this->brojUgovora . " je besplatno posetio " . $url . " jer ima " . $dodatak->tipdodatka . " dodatak. <br><br>";
                return true;
            }
        }

        $cenaPosete = $mb * $this->tarifniPaket->cenaPoMegabajtu;
        if ($this->kredit >= $cenaPosete)
        {
            $this->internetProvajder->zabeleziSaobracaj($this,$url,$mb);
            $listing = new ListingUnos($url,$mb);
            $this->dodajListingUnos($listing);
            $this->kredit -= $cenaPosete;
            echo "Sa racuna je skinuto " . $cenaPosete . " kredita.<br><br>";
            return true;
        }
        else
        {
            echo "Nemate dovoljno kredita, molimo dopunite kredit.<br><br>";
            return  false;
        }
    }
}

