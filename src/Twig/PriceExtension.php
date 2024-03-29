<?php

namespace Kematjaya\Currency\Twig;

use Kematjaya\Currency\Lib\CurrencyFormatInterface;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceExtension extends AbstractExtension 
{
    
    /**
     * 
     * @var CurrencyFormatInterface
     */
    private $currencyFormat;

    public function __construct(CurrencyFormatInterface $currencyFormat)
    {
        $this->currencyFormat = $currencyFormat;
    }
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('price', array($this, 'price'), array('is_safe' => array('html')))
        );
    }
    
    public function price(float $number = 0)
    {
        return $this->currencyFormat->formatPrice($number);
    }
}
