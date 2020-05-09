<?php

class TarifniPaket
{
    public $maksimalnaBrzina;
    public $cenaPaketa;
    public $neogranicenSaobracaj;
    public $gb;
    public $cenaPoGigabajtu;

    /**
     * TarifniPaket constructor.
     * @param int $maksimalnaBrzina
     * @param float $cenaPaketa
     * @param bool $neogranicenSaobracaj
     * @param int $gb
     * @param float $cenaPoGigabajtu
     */
    public function __construct(int $maksimalnaBrzina, float $cenaPaketa, bool $neogranicenSaobracaj, int $gb, float $cenaPoGigabajtu)
    {
        $this->maksimalnaBrzina = $maksimalnaBrzina;
        $this->cenaPaketa = $cenaPaketa;
        $this->neogranicenSaobracaj = $neogranicenSaobracaj;
        $this->gb = $gb;
        $this->cenaPoGigabajtu = $cenaPoGigabajtu;
    }

}