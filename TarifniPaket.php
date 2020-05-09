<?php

class TarifniPaket
{
    public int $maksimalnaBrzina;
    public float $cenaPaketa;
    public bool $neogranicenSaobracaj;
    public int $mb;
    public float $cenaPoMegabajtu;

    /**
     * TarifniPaket constructor.
     * @param int $maksimalnaBrzina
     * @param float $cenaPaketa
     * @param bool $neogranicenSaobracaj
     * @param int $mb
     * @param float $cenaPoMegabajtu
     */
    public function __construct(int $maksimalnaBrzina, float $cenaPaketa, bool $neogranicenSaobracaj, int $mb, float $cenaPoMegabajtu)
    {
        $this->maksimalnaBrzina = $maksimalnaBrzina;
        $this->cenaPaketa = $cenaPaketa;
        $this->neogranicenSaobracaj = $neogranicenSaobracaj;
        $this->mb = $mb;
        $this->cenaPoMegabajtu = $cenaPoMegabajtu;
    }

}