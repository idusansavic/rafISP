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
            if ($korisnik instanceof PostpaidKorisnik)
            {
                $korisnik->generisiRacun();
            }
        }
    }


    public function zabeleziSaobracaj(Korisnik $korisnik, string $url, int $mb)
    {
        $zabelezenSaobracaj = "Korisnik " . $korisnik->brojUgovora . " ostvario saobracaj ka adresi " . $url . " , potroseno " . $mb . " Mb.<br><br>";
        echo $zabelezenSaobracaj;
    }


    public function prikazPrepaidKorisnika()
    {
        $prikaz = "";
        foreach ($this->listaKorisnika as $korisnik) {
            if ($korisnik instanceof PrepaidKorisnik) {
                $prikaz .= "<br><br>Broj ugovora: " . $korisnik->brojUgovora . "<br>";
                $prikaz .= "Korisnik: " . $korisnik->ime . " " . $korisnik->prezime . "<br>";
                $prikaz .= "Stanje kredita: " . $korisnik->kredit . " rsd;<br>";
                $prikaz .= "Tarifni dodaci: ";
                foreach ($korisnik->tarifniDodaci as $dodatak) {
                    $prikaz .= "- " . $dodatak->tipDodatka . "; ";
                }
            }
        }
        echo $prikaz . "<br><br>";
    }


    public function prikazPostpaidKorisnika()
    {
        $prikaz = "";
        foreach ($this->listaKorisnika as $korisnik) {
            if ($korisnik instanceof PostpaidKorisnik) {
                $prikaz .= "<br><br>Broj ugovora: " . $korisnik->brojUgovora . "<br>";
                $prikaz .= "Korisnik: " . $korisnik->ime . " " . $korisnik->prezime . "<br>";
                $prikaz .= "Brzina: " . $korisnik->tarifniPaket->maksimalnaBrzina . " Mbps;<br>";
                $prikaz .= "Tarifni dodaci: ";
                foreach ($korisnik->tarifniDodaci as $dodatak) {
                    $prikaz .= "- " . $dodatak->tipDodatka . "; ";
                }
            }
        }
        echo $prikaz . "<br><br>";
    }


    public function dodajKorisnika(Korisnik $korisnik)
    {
        foreach ($this->listaKorisnika as $ugovor)
        {
            if ($ugovor->brojUgovora == $korisnik->brojUgovora)
            {
                echo "Korisnik sa brojem ugovora " . $korisnik->brojUgovora . " vec postoji!<br><br>";
                return;
            }
        }
        array_push($this->listaKorisnika, $korisnik);
        echo "Uspesno ste dodali korisnika sa brojem ugovora " . $korisnik->brojUgovora . ".<br><br>";
    }
}