<?php

namespace Kematjaya\Currency\Twig;

use Kematjaya\Currency\Lib\CurrencyFormat;
use Twig\TwigFunction;
use Twig\TwigFilter;
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
    
    public function getFilters()
    {
        return [
            new TwigFilter('terbilang', [$this, 'getTerbilang']),
        ];
    }
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('price', array($this, 'price'), array('is_safe' => array('html')))
        );
    }
    
    public function getTerbilang($number, $curency = null) {
        return $this->currencyFormat->terbilang($number, $curency);
    }
    
    public function price($number)
    {
        return $this->currencyFormat->formatPrice($number);
    }
}
