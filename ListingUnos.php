<?php

class ListingUnos
{

    public string $url;
    public int $mb;

    /**
     * ListingUnos constructor.
     * @param string $url
     * @param int $mb
     */
    public function __construct(string $url, int $mb)
    {
        $this->url = $url;
        $this->mb = $mb;
    }


    public function dodajMegabajte(int $mb)
    {
        $this->mb = $this->mb + $mb;
        echo ("Povecani megabajti za " . $this->url . ".");
        echo "<br>";
        echo "<br>";

    }



}