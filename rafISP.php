<?php

require_once "Korisnik.php";
require_once "PrepaidKorisnik.php";
require_once "PostpaidKorisnik.php";
require_once "InternetProvajder.php";
require_once "ListingUnos.php";
require_once "IzradaListinga.php";
require_once "TarifniPaket.php";
require_once "TarifniDodatak.php";


// InternetProvajder instance
$internetProvajder = new InternetProvajder("SBB", array());
var_dump($internetProvajder);
echo "<br>";
echo "<br>";


//TarifniPaket instance
$prepaidSilver = new TarifniPaket(100, 1500, false, 102400, 0.01464 );
$prepaidGold = new TarifniPaket(200, 2000, false, 204800, 0.00976 );
$postpaidSilver = new TarifniPaket(100, 2000, true, 204800, 0.00976 );
$postpaidGold = new TarifniPaket(200, 2500, true, 307200, 0.00813 );
var_dump($postpaidGold);
echo "<br>";
echo "<br>";


// TarifniDodatak instance
$facebook = new TarifniDodatak(400, "Facebook");
$twitter = new TarifniDodatak(300, "Twitter");
$instagram = new TarifniDodatak(500, "Instagram");
$viber = new TarifniDodatak(200, "Viber");
$iptv = new TarifniDodatak(900, "IPTV");
$fiksna = new TarifniDodatak(600, "Fiksna");
var_dump($facebook);
echo "<br>";
echo "<br>";


//ListingUnos se poziva iz surfuj pa dodaj listing unos = new listingunos, takodje se zabelezi zaobracaj poziva kada korisnik surfuje
$listingUnos1 = new ListingUnos("www.twitch.com", 230);
var_dump($listingUnos1);
echo "<br>";
echo "<br>";

// PrepaidKorisnik instance
$prepaidUser1 = new PrepaidKorisnik( 1500, $internetProvajder, "Petar", "Bojovic", "Kralja Petra 9", 101, $prepaidSilver, array($facebook, $instagram));
$prepaidUser2 = new PrepaidKorisnik( 500, $internetProvajder, "Frenki", " Radosavljevic", "Frenkijeva 666", 102, $prepaidGold, array());
var_dump($prepaidUser1);
echo "<br>";
echo "<br>";


// PostpaidKorisnik instance
$postpaidUser1 = new PostpaidKorisnik( 500, $internetProvajder, "Todor", "Mihailovic", "Planeta Krypton 77", 103, $postpaidSilver, array($iptv, $fiksna));
$postpaidUser2 = new PostpaidKorisnik( 0, $internetProvajder, "Mike", "Tyson", "Beverly Hills 23", 104, $postpaidGold, array($instagram, $iptv, $fiksna));
var_dump($postpaidUser1);
echo "<br>";
echo "<br>";


//TESTOVI METODA
$listingUnos1->dodajMegabajte(430);
var_dump($listingUnos1);
echo "<br>";
echo "<br>";
