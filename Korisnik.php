<?php

require_once "IzradaListinga.php";
require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "ListingUnos.php";
require_once "TarifniDodatak.php";


abstract class Korisnik implements IzradaListinga
{
    public InternetProvajder $internetProvajder;
    public string $ime;
    public string $prezime;
    public string $adresa;
    public int $brojUgovora;
    public TarifniPaket $tarifniPaket;
    public array $tarifniDodaci = [];
    public array $listaListingUnosa = [];

    /**
     * Korisnik constructor.
     * @param InternetProvajder $internetProvajder
     * @param string $ime
     * @param string $prezime
     * @param string $adresa
     * @param int $brojUgovora
     * @param TarifniPaket $tarifniPaket
     * @param array $tarifniDodaci
     * @param array $listaListingUnosa
     */
    public function __construct(InternetProvajder $internetProvajder, string $ime, string $prezime, string $adresa, int $brojUgovora, TarifniPaket $tarifniPaket, array $tarifniDodaci, array $listaListingUnosa)
    {
        $this->internetProvajder = $internetProvajder;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->adresa = $adresa;
        $this->brojUgovora = $brojUgovora;
        $this->tarifniPaket = $tarifniPaket;
        $this->tarifniDodaci = $tarifniDodaci;
        $this->listaListingUnosa = $listaListingUnosa;
    }


    public function dodajListingUnos(ListingUnos $listingUnos)
    {
        foreach ($this->listaListingUnosa as $unos)
        {
            if ($unos->url == $listingUnos->url)
            {
                $unos->dodajMegabajte($listingUnos->mb);
                return;
            }
        }
        array_push($this->listaListingUnosa, $listingUnos);
        echo "Dodali ste novi listing unos za adresu " . $listingUnos->url . "<br><br>";
    }


    public function napraviListing() : string
    {
        $n = count($this->listaListingUnosa);
        for ($i = 0; $i < $n-1; $i++)
        {
            $min = $i;
            for ($j = $i+1; $j < $n; $j++)
                if ($this->listaListingUnosa[$j]->mb > $this->listaListingUnosa[$min]->mb)
                    $min = $j;

            $temp = $this->listaListingUnosa[$min];
            $this->listaListingUnosa[$min] = $this->listaListingUnosa[$i];
            $this->listaListingUnosa[$i] = $temp;
        }

        $listing = "";
        foreach ($this->listaListingUnosa as $unos)
        {
            $listing .= "URL: " . $unos->url;
            $listing .= " MB: " . $unos->mb . "<br>";
        }
        echo "LISTING <br> Korisnik: " . $this->ime . " " . $this->prezime . "<br>Broj ugovora: " . $this->brojUgovora . "<br><br>" . $listing;
        return $listing;
    }

    abstract function surfuj(string $url, int $mb) : bool;

    abstract function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak);
}