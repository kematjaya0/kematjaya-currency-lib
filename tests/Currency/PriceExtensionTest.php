<?php

namespace Kematjaya\Currency\Tests\Currency;

use Kematjaya\Currency\Tests\KmjKernelTest;
use Kematjaya\Currency\Lib\CurrencyFormat;
use Kematjaya\Currency\Twig\PriceExtension;
use Kematjaya\Currency\Twig\ConverterExtension;
use PHPUnit\Framework\TestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceExtensionTest extends TestCase
{
    private $kernel;
    
    protected function setUp(): void 
    {
        parent::setUp();
        
        $kernel  = new KmjKernelTest('test', true);
        $kernel->boot();
        
        $this->kernel = $kernel;
    }
    
    public function testFormatPrice()
    {
        $currencyFormat = new CurrencyFormat($this->kernel->getContainer());
        $ext = new PriceExtension($currencyFormat);
        
        $this->assertEquals($currencyFormat->getCurrencySymbol().' 10,000', $ext->price(10000));
    }
    
    public function testGetTerbilang()
    {
        $ext = new ConverterExtension(new \Kematjaya\Currency\Converter\IndonesianConverter());
        $this->assertEquals("sepuluh ribu", strtolower($ext->getTerbilang(10000)));
        $this->assertEquals("sepuluh", strtolower($ext->getTerbilang(10)));
    }
}
