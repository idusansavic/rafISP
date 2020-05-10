<?php

require_once "Korisnik.php";

class InternetProvajder
{
    public string $ime;
    public array $listaKorisnika;

    /**
     * InternetProvajder constructor.
     * @param $ime
     * @param $listaKorisnika
     */
    public function __construct(string $ime, array $listaKorisnika)
    {
        $this->ime = $ime;
        $this->listaKorisnika = $listaKorisnika;
    }


    public function generisiRacune()
    {
        foreach ($this->listaKorisnika as $korisnik)
        {
            if ($korisnik->tarifniPaket->neogranicenSaobracaj == "true")
            {
                $korisnik->generisiRacun();

            }
        }

    }

    public function zabeleziSaobracaj(Korisnik $korisnik, string $url, int $mb)
    {
        // TODO zabeleziSaobracaj
    }

    public function prikazPrepaidKorisnika()
    {
        foreach ($this->listaKorisnika as $korisnik) {
            if ($korisnik->tarifniPaket->neogranicenSaobracaj == false) {
                echo "Broj ugovora: " . $korisnik->brojUgovora;
                echo "<br>";
                echo "Korisnik: " . $korisnik->ime . " " . $korisnik->prezime;
                echo "<br>";
                echo "Stanje kredita: " . $korisnik->kredit . " rsd;";
                echo "<br>";
                echo "Tarifni dodaci: ";
                foreach ($korisnik->tarifniDodaci as $dodatak) {
                    echo "- " . $dodatak->tipDodatka . "; ";
                }
                echo "<br>";
                echo "<br>";

            }

        }
    }

    public function prikazPostpaidKorisnika()
    {
        foreach ($this->listaKorisnika as $korisnik) {
            if ($korisnik->tarifniPaket->neogranicenSaobracaj == true) {
                echo "Broj ugovora: " . $korisnik->brojUgovora;
                echo "<br>";
                echo "Korisnik: " . $korisnik->ime . " " . $korisnik->prezime;
                echo "<br>";
                echo "Brzina: " . $korisnik->tarifniPaket->maksimalnaBrzina . " Mbps;";
                echo "<br>";
                echo "Tarifni dodaci: ";
                foreach ($korisnik->tarifniDodaci as $dodatak) {
                    echo "- " . $dodatak->tipDodatka . "; ";
                }
                echo "<br>";
                echo "<br>";

            }

        }

    }

    public function dodajKorisnika(Korisnik $korisnik)
    {
        // TODO dodajKorisnika

    }


}