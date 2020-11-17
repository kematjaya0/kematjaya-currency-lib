<?php

namespace Kematjaya\Currency\Twig;

use Kematjaya\Currency\Lib\CurrencyFormat;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceExtension extends AbstractExtension 
{
    private $currencyFormat;

    public function __construct(CurrencyFormat $currencyFormat)
    {
        $this->currencyFormat = $currencyFormat;
    }
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('price', array($this, 'price'), array('is_safe' => array('html')))
        );
    }
    
    public function price($number)
    {
        return $this->currencyFormat->formatPrice($number);
    }
}
