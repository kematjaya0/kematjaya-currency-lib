<?php

namespace Kematjaya\Currency\DataTransformer;

use Kematjaya\Currency\Lib\CurrencyFormat;
use Symfony\Component\Form\DataTransformerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceDataTransformer implements DataTransformerInterface
{
    public function __construct(CurrencyFormat $currencyFormat) 
    {
        $this->currencyFormat = $currencyFormat;
    }
    
    public function reverseTransform($value) 
    {   
        return ($value) ? $this->currencyFormat->PriceToFloat($value):0;
    }

    public function transform($value) 
    {
        return ($value) ? $this->currencyFormat->PriceToFloat($value) : 0;
    }
}
