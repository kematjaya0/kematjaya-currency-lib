<?php

namespace Kematjaya\Tests\Currency;

use Kematjaya\Currency\Lib\Terbilang;
use Kematjaya\Currency\Lib\CurrencyFormat;
use Kematjaya\Currency\KmjCurrencyBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjCurrencyTestingKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new KmjCurrencyBundle()
        ];
    }
    
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        
    }
}

class CurrencyFormatTest extends TestCase {
    
    public function testConvert()
    {
        $cr = new Terbilang();
        $this->assertEquals('seratus', trim(strtolower($cr->convertToString(100))));
    }
    
    public function testCurrency()
    {
        $kernel  = new KmjCurrencyTestingKernel('test', true);
        $kernel->boot();
        $currencyFormat = new CurrencyFormat($kernel->getContainer());
        $this->assertEquals(10000, $currencyFormat->PriceToFloat($currencyFormat->getCurrencySymbol().'10000'));
        $this->assertEquals($currencyFormat->getCurrencySymbol().'10,000', $currencyFormat->formatPrice(10000));
    }
}
