<?php

class InternetProvajder
{
    public string $ime;
    public array $listaKorisnika = [];

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

    }

    public function zabeleziSaobracaj(Korisnik $korisnik, string $url, int $mb)
    {

    }

    public function prikazPrepaidKorisnika()
    {

    }

    public function prikazPostpaiddKorisnika()
    {

    }

    public function dodajKorisnika(Korisnik $korisnik)
    {

    }


}