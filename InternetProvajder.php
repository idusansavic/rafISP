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
            if ($korisnik instanceof PrepaidKorisnik) {
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
            if ($korisnik instanceof PostpaidKorisnik) {
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
        foreach ($this->listaKorisnika as $ugovor)
        {
            if ($ugovor->brojUgovora == $korisnik->brojUgovora)
            {
                echo "Korisnik sa brojem ugovora " . $korisnik->brojUgovora . " vec postoji!";
                echo "<br>";
                echo "<br>";
                return;

            }

        }

        array_push($this->listaKorisnika, $korisnik);
        echo "Uspesno ste dodali korisnika sa brojem ugovora " . $korisnik->brojUgovora;
        echo "<br>";
        echo "<br>";

    }


}