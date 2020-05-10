<?php

require_once "Korisnik.php";
require_once "PrepaidKorisnik.php";
require_once "PostpaidKorisnik.php";
require_once "InternetProvajder.php";
require_once "ListingUnos.php";
require_once "IzradaListinga.php";
require_once "TarifniPaket.php";
require_once "TarifniDodatak.php";

//INSTANCE KLASA
// InternetProvajder instance
$internetProvajder = new InternetProvajder("SBB", array());

//TarifniPaket instance
$prepaidSilver = new TarifniPaket(100, 1500, false, 102400, 0.01464 );
$prepaidGold = new TarifniPaket(200, 2000, false, 204800, 0.00976 );
$postpaidSilver = new TarifniPaket(100, 2000, true, 204800, 0.00976 );
$postpaidGold = new TarifniPaket(200, 2500, true, 307200, 0.00813 );

// TarifniDodatak instance
$facebook = new TarifniDodatak(400, "Facebook");
$twitter = new TarifniDodatak(300, "Twitter");
$instagram = new TarifniDodatak(500, "Instagram");
$viber = new TarifniDodatak(200, "Viber");
$iptv = new TarifniDodatak(900, "IPTV");
$fiksna = new TarifniDodatak(600, "Fiksna");

//ListingUnos se poziva iz surfuj pa dodaj listing unos = new listingunos, takodje se zabelezi zaobracaj poziva kada korisnik surfuje
$listingUnos1 = new ListingUnos("www.twitch.com", 230);
$listingUnos2 = new ListingUnos("www.pornhub.com", 80424);

// PrepaidKorisnik instance
$prepaidUser1 = new PrepaidKorisnik( 1500, $internetProvajder, "Petar", "Bojovic", "Kralja Petra 9", 101, $prepaidSilver, array($facebook, $instagram), array());
$prepaidUser2 = new PrepaidKorisnik( 500, $internetProvajder, "Frenki", " Radosavljevic", "Frenkijeva 666", 102, $prepaidGold, array(), array());

// PostpaidKorisnik instance
$postpaidUser1 = new PostpaidKorisnik( 500, $internetProvajder, "Todor", "Mihailovic", "Planeta Krypton 77", 103, $postpaidSilver, array($fiksna), array($listingUnos2
));
$postpaidUser2 = new PostpaidKorisnik( 0, $internetProvajder, "Mike", "Tyson", "Beverly Hills 23", 104, $postpaidGold, array($iptv, $fiksna), array());


//TESTOVI METODA
//1. Metode PrepaidKorisnik
echo "1. PREPAID KORISNIK DODAJ TARIFNI DODATAK";echo "<br>"; echo "<br>";
$prepaidUser1->dodajTarifniDodatak($twitter); //Dodatak koji se moze dodati
$prepaidUser1->dodajTarifniDodatak($facebook); //Dodatak koji vec postoji
$prepaidUser1->dodajTarifniDodatak($iptv); //Dodatak koji se ne moze dodati

echo "2. PREPAID KORISNIK DOPUNI KREDIT"; echo "<br>"; echo "<br>";
$prepaidUser1->dopuniKredit(666);

//2. Metode PostpaidKorisnik
echo "3. POSTPAID KORISNIK UKUPNO ZA NAPLATU"; echo "<br>"; echo "<br>";
$postpaidUser1->ukupnoZaNaplatu();

echo "4. POSTPAID KORISNIK GENERISI RACUN"; echo "<br>"; echo "<br>";
$postpaidUser1->generisiRacun();

echo "5. POSTPAID KORISNIK DODAJ TARIFNI DODATAK"; echo "<br>"; echo "<br>";
$postpaidUser1->dodajTarifniDodatak($iptv); //Dodatak koji se moze dodati
$postpaidUser1->dodajTarifniDodatak($fiksna); //Dodatak koji vec postoji
$postpaidUser1->dodajTarifniDodatak($facebook); //Dodatak koji se ne moze dodati

//3. Metoda ListingUnos
echo "6. LISTING UNOS DODAJ MEGABAJTE"; echo "<br>"; echo "<br>";
$listingUnos1->dodajMegabajte(430);

//4. Metode InternetProvajder
array_push($internetProvajder->listaKorisnika, $prepaidUser1, $prepaidUser2, $postpaidUser1);

echo "7. INTERNET PROVAJDER GENERISI RACUNE"; echo "<br>"; echo "<br>";
$internetProvajder->generisiRacune();

echo "8. INTERNET PROVAJDER PRIKAZ PREPAID KORISNIKA"; echo "<br>"; echo "<br>";
$internetProvajder->prikazPrepaidKorisnika();

echo "9. INTERNET PROVAJDER PRIKAZ POSTPAID KORISNIKA"; echo "<br>"; echo "<br>";
$internetProvajder->prikazPostpaidKorisnika();

echo "10. INTERNET PROVAJDER DODAJ KORISNIKA"; echo "<br>"; echo "<br>";
$internetProvajder->dodajKorisnika($postpaidUser2); //Novi korisnik
$internetProvajder->dodajKorisnika($postpaidUser1); //Postojeci korisnik

//5. Metode Korisnik
echo "11. KORISNIK DODAJ LISTIN UNOS"; echo "<br>"; echo "<br>";
$postpaidUser1->dodajListingUnos($listingUnos2);
