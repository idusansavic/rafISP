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
        echo "Uspesno ste dopunili kredit, trenutno imate " . $this->kredit . " kredita";
        echo "<br>";
        echo "<br>";

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
        elseif ($this instanceof PrepaidKorisnik)
        {
            if ($tarifniDodatak->tipDodatka == "IPTV" or $tarifniDodatak->tipDodatka == "Fiksna")
            {
                echo "Ne mozete dodati " . $tarifniDodatak->tipDodatka . " tarifni dodatak PREPAID korisniku!";
                echo "<br>";
                echo "<br>";
            } else
            {
                array_push($this->tarifniDodaci, $tarifniDodatak);
                echo "Uspesno ste dodali " . $tarifniDodatak->tipDodatka . " tarifni dodatak.";
                echo "<br>";
                echo "<br>";
            }


        }
    }

}

