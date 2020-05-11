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
$prepaidDuo = new TarifniPaket(50, 1500, false, 102400, 0.01464 );
$prepaidSilver = new TarifniPaket(100, 1500, false, 102400, 0.01464 );
$prepaidGold = new TarifniPaket(200, 2000, false, 204800, 0.00976 );
$postpaidBronze = new TarifniPaket(100, 2000, false, 0, 0.00976 );
$postpaidDuo = new TarifniPaket(100, 2000, false, 100000, 0.00976 );
$postpaidSilver = new TarifniPaket(100, 2000, true, 204800, 0.00976 );
$postpaidGold = new TarifniPaket(200, 2500, true, 307200, 0.00813 );

// TarifniDodatak instance
$facebook = new TarifniDodatak(400, "Facebook");
$twitter = new TarifniDodatak(300, "Twitter");
$instagram = new TarifniDodatak(500, "Instagram");
$viber = new TarifniDodatak(200, "Viber");
$iptv = new TarifniDodatak(900, "IPTV");
$fiksna = new TarifniDodatak(600, "Fiksna");

//ListingUnos instance
$listingUnos1 = new ListingUnos("www.facebook.com", 230);
$listingUnos2 = new ListingUnos("www.twitter.com", 80424);
$listingUnos3 = new ListingUnos("www.instagram.com", 60000);
$listingUnos4 = new ListingUnos("www.twitch.com", 8000);
$listingUnos5 = new ListingUnos("www.pornhub.com", 237000);

// PrepaidKorisnik instance
$prepaidUser1 = new PrepaidKorisnik( 2000, $internetProvajder, "Petar", "Bojovic", "Kralja Petra 9", 101, $prepaidSilver, array($facebook), array());
$prepaidUser2 = new PrepaidKorisnik( 0, $internetProvajder, "Frenki", " Radosavljevic", "Frenkijeva 666", 102, $prepaidGold, array(), array());

// PostpaidKorisnik instance
$postpaidUser1 = new PostpaidKorisnik( 500, $internetProvajder, "Todor", "Mihailovic", "Planet Krypton 77", 103, $postpaidSilver, array($fiksna), array($listingUnos1, $listingUnos2
));
$postpaidUser2 = new PostpaidKorisnik( 0, $internetProvajder, "Mike", "Tyson", "Beverly Hills 23", 104, $postpaidGold, array($iptv, $fiksna), array());
$postpaidUser3 = new PostpaidKorisnik( 200, $internetProvajder, "Muten", "Roshi", "Kame Island 1", 105, $postpaidBronze, array($instagram), array());
$postpaidUser4 = new PostpaidKorisnik( 0, $internetProvajder, "Vuk", "Karadzic", "Trsic 1", 106, $postpaidDuo, array(), array());


//TESTOVI METODA
//1. Metode PrepaidKorisnik
echo "1. PREPAID KORISNIK DODAJ TARIFNI DODATAK"; echo "<br><br>";
$prepaidUser1->dodajTarifniDodatak($twitter); //Dodatak koji se moze dodati
$prepaidUser1->dodajTarifniDodatak($facebook); //Dodatak koji vec postoji
$prepaidUser1->dodajTarifniDodatak($iptv); //Dodatak koji se ne moze dodati

echo "2. PREPAID KORISNIK DOPUNI KREDIT"; echo "<br><br>";
$prepaidUser1->dopuniKredit(666);

echo "3. PREPAID KORISNIK SURFUJ"; echo "<br><br>";
echo "SURF 1 <br>";
$prepaidUser1->surfuj("www.facebook.com", 122000); // Ima dodatak
echo "SURF 2 <br>";
$prepaidUser1->surfuj("www.pornhub.com", 5000); // Ima kredita
echo "SURF 3 <br>";
$prepaidUser2->surfuj("www.pornhub.com", 122000); // Nema kredita


//2. Metode PostpaidKorisnik
echo "4. POSTPAID KORISNIK UKUPNO ZA NAPLATU"; echo "<br><br>";
echo "Ukupno za naplatu: " . $postpaidUser1->ukupnoZaNaplatu() . "rsd.<br><br>";

echo "5. POSTPAID KORISNIK GENERISI RACUN"; echo "<br><br>";
$postpaidUser1->generisiRacun();

echo "6. POSTPAID KORISNIK DODAJ TARIFNI DODATAK"; echo "<br><br>";
$postpaidUser1->dodajTarifniDodatak($fiksna); //Dodatak koji vec postoji
$postpaidUser1->dodajTarifniDodatak($iptv); //Dodatak koji se moze dodati NEOGRANICENOM
$postpaidUser1->dodajTarifniDodatak($facebook); //Dodatak koji se ne moze dodati NEOGRANICENOM
$postpaidUser3->dodajTarifniDodatak($facebook); //Dodatak koji se moze dodati OGRANICENOM
$postpaidUser3->dodajTarifniDodatak($fiksna); //Dodatak koji se moze dodati OGRANICENOM


echo "7. POSTPAID KORISNIK SURFUJ"; echo "<br><br>";
echo "SURF 1 <br>";
$postpaidUser1->surfuj("www.pornhub.com", 122000); // Ima besplatan internet
echo "SURF 2 <br>";
$postpaidUser3->surfuj("www.instagram.com", 122000); // Ima dodatak za URL
echo "SURF 3 <br>";
$postpaidUser3->surfuj("www.pornhub.com", 122000); // Prekorcio Mb
echo "SURF 4 <br>";
$postpaidUser4->surfuj("www.vukajlija.com", 5000); // Surfovao


//3. Metoda ListingUnos
echo "8. LISTING UNOS DODAJ MEGABAJTE"; echo "<br><br>";
$listingUnos1->dodajMegabajte(430);

//4. Metode InternetProvajder
array_push($internetProvajder->listaKorisnika, $prepaidUser1, $prepaidUser2, $postpaidUser1, $postpaidUser2);

echo "9. INTERNET PROVAJDER GENERISI RACUNE"; echo "<br><br>";
$internetProvajder->generisiRacune();

echo "10. INTERNET PROVAJDER ZABELEZI SAOBRACAJ"; echo "<br><br>";
$internetProvajder->zabeleziSaobracaj($postpaidUser1, "www.pornhub.com", 70450);

echo "11. INTERNET PROVAJDER PRIKAZ PREPAID KORISNIKA";
$internetProvajder->prikazPrepaidKorisnika();

echo "12. INTERNET PROVAJDER PRIKAZ POSTPAID KORISNIKA";
$internetProvajder->prikazPostpaidKorisnika();

echo "13. INTERNET PROVAJDER DODAJ KORISNIKA"; echo "<br><br>";
$internetProvajder->dodajKorisnika($postpaidUser3); //Novi korisnik
$internetProvajder->dodajKorisnika($postpaidUser1); //Postojeci korisnik

//5. Metode Korisnik
echo "14. KORISNIK DODAJ LISTING UNOS"; echo "<br><br>";
$postpaidUser1->dodajListingUnos($listingUnos1); //Postojeci unos
$postpaidUser1->dodajListingUnos($listingUnos2); //Postojeci unos
$postpaidUser1->dodajListingUnos($listingUnos3); //Nepostojeci unos
$postpaidUser1->dodajListingUnos($listingUnos4); //Nepostojeci unos
$postpaidUser1->dodajListingUnos($listingUnos5); //Nepostojeci unos

echo "15. KORISNIK NAPRAVI LISTING"; echo "<br><br>";
$postpaidUser1->napraviListing();
