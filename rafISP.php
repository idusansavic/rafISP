<?php


require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "TarifniDodatak.php";
require_once "PrepaidKorisnik.php";
require_once "PostpaidKorisnik.php";

// InternetProvajder instance
$internetProvajder = new InternetProvajder("SBB", array());
var_dump($internetProvajder);
echo "<br>";


//TarifniPaket instance
$prepaidSilver = new TarifniPaket(100, 1500, false, 100, 15 );
$prepaidGold = new TarifniPaket(200, 2000, false, 200, 10 );
$postpaidSilver = new TarifniPaket(100, 2000, true, 200, 10 );
$postpaidGold = new TarifniPaket(200, 2500, true, 300, 8.33 );
var_dump($postpaidGold);
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


//ListingUnos se poziva iz surfuj pa dodaj listing unos = new listingunos, takodje se zabelezi zaobracaj poziva kada korisnik surfuje


// PrepaidKorisnik instance
$prepaidUser1 = new PrepaidKorisnik( 1500, $internetProvajder, "Petar", "Bojovic", "Kralja Petra 9", 101, $prepaidSilver, array($facebook, $instagram));
$prepaidUser2 = new PrepaidKorisnik( 500, $internetProvajder, "Frenki", " Radosavljevic", "Frenkijeva 666", 102, $prepaidGold, array());
var_dump($prepaidUser1);
echo "<br>";


// PrepaidKorisnik instance
$postpaidUser1 = new PostpaidKorisnik( 500, $internetProvajder, "Todor", "Mihailovic", "Planeta Krypton 77", 103, $postpaidSilver, array($iptv, $fiksna));
$postpaidUser2 = new PostpaidKorisnik( 0, $internetProvajder, "Mike", "Tyson", "Beverly Hills 23", 104, $postpaidGold, array($instagram, $iptv, $fiksna));
var_dump($postpaidUser1);
echo "<br>";
