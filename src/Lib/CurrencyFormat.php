<?php

namespace Kematjaya\Currency\Lib;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Currencies;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class CurrencyFormat 
{
    /**
     *
     * @var float
     */
    private $centLimit = 0;
    
    /**
     *
     * @var string
     */
    private $centPoint = '.';
    
    /**
     *
     * @var string
     */
    private $thousandPoint = ',';
    
    /**
     *
     * @var string
     */
    private $currency;
    
    /**
     *
     * @var ContainerInterface
     */
    private $container;
    
    function __construct(ContainerInterface $container) 
    {
        $this->container    = $container;
        $this->currency     = ($container->hasParameter('currency')) ? $container->getParameter('currency') : "IDR";
        $this->centLimit    = ($container->hasParameter('cent_limit')) ? $container->getParameter('cent_limit') : 0;
        $this->centPoint    = ($container->hasParameter('cent_point')) ? $container->getParameter('cent_point') : '.';
        $this->thousandPoint = ($container->hasParameter('thousand_point')) ? $container->getParameter('thousand_point') : ',';
        
        $names = Currencies::getNames();
        if(!isset($names[$this->currency]))
        {
            throw new \Exception(sprintf("%s not supported", $this->currency));
        }
        
    }
    
    /**
     * 
     * @param type string currency code ex: "IDR", "USD"
     * @return string|null
     */
    public function getCurrencySymbol():?string
    {
        return Currencies::getSymbol($this->currency);
    }
    
    public function setCentLimit(string $centLimit):self
    {
        $this->centLimit = $centLimit;
        
        return $this;
    }
    
    public function getCentLimit():string
    {
        return $this->centLimit;
    }
    
    public function setCurrency(string $currency):self
    {
        $names = Currencies::getNames();
        if(!isset($names[$currency]))
        {
            throw new \Exception(sprintf("%s not supported", $currency));
        }
        
        $this->currency = $currency;
        
        return $this;
    }
    
    public function PriceToFloat(string $price):float
    {
        $number = (float) str_replace($this->thousandPoint, '', str_replace($this->getCurrencySymbol(), '', $price));
        
        return $number;
    }
    
    public function formatPrice(float $number):string
    {
        $currencyCode = $this->getCurrencySymbol();
        
        return $currencyCode . " " . number_format($number, $this->centLimit, $this->centPoint, $this->thousandPoint);
    }
}
