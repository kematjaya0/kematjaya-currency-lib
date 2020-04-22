<?php

namespace Kematjaya\Currency\Lib;

use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class CurrencyFormat 
{
    
    private $centLimit = 0;
    private $centPoint = '.';
    private $thousandPoint = ',';
    private $currency;
    private $container;
    
    function __construct(ContainerInterface $container) {
        $this->container    = $container;
        $this->currency     = ($container->hasParameter('currency')) ? $container->getParameter('currency') : "IDR";
        $this->centLimit    = ($container->hasParameter('cent_limit')) ? $container->getParameter('cent_limit') : 0;
        $this->centPoint    = ($container->hasParameter('cent_point')) ? $container->getParameter('cent_point') : '.';
        $this->thousandPoint = ($container->hasParameter('thousand_point')) ? $container->getParameter('thousand_point') : ',';
    }
    
    /**
     * 
     * @param type string currency code ex: "IDR", "USD"
     * @return string|null
     */
    public function getCurrencySymbol():?string
    {
        switch($this->currency) {
            case "IDR":
                return "Rp.";
                break;
            case "USD":
                return "USD ";
                break;
            default:
                break;
        }
    }
    
    public function setCentLimit($centLimit)
    {
        $this->centLimit = $centLimit;
        
        return $this;
    }
    
    public function getCentLimit()
    {
        return $this->centLimit;
    }
    
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        
        return $this;
    }
    
    public function PriceToFloat($price)
    {
        $number = (float) str_replace($this->thousandPoint, '', str_replace($this->getCurrencySymbol(), '', $price));
        return $number;
    }
    
    public function formatPrice($number)
    {
        $currencyCode = $this->getCurrencySymbol();
        
        return $currencyCode . number_format($number, $this->centLimit, $this->centPoint, $this->thousandPoint);
    }
}
