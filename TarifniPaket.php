<?php

class TarifniPaket
{
    public int $maksimalnaBrzina;
    public float $cenaPaketa;
    public bool $neogranicenSaobracaj;
    public int $gb;
    public float $cenaPoGigabajtu;

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