<?php

require_once "requireList.php";

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

    }



}