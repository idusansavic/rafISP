<?php



class TarifniDodatak
{
    public $cena;
    public $tipDodatka;

    /**
     * TarifniDodatak constructor.
     * @param float $cena
     * @param string $tipDodatka
     */
    public function __construct(float $cena, string $tipDodatka)
    {
        $this->cena = $cena;
        $this->tipDodatka = $tipDodatka;
    }

}