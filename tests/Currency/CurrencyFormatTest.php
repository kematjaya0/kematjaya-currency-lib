<?php

namespace Kematjaya\Currency\Tests\Currency;

use Kematjaya\Currency\Converter\IndonesianConverter;
use Kematjaya\Currency\Lib\CurrencyFormat;
use Kematjaya\Currency\Tests\KmjKernelTest;
use PHPUnit\Framework\TestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */

class CurrencyFormatTest extends TestCase 
{
    
    public function testIndonesianConvert()
    {
        $converter = new IndonesianConverter();
        
        $this->assertEquals('seratus', trim(strtolower($converter->convert(100))));
        $this->assertEquals('seratus rupiah', trim(strtolower($converter->convert(100, true))));
        
        $this->assertEquals('seribu', trim(strtolower($converter->convert(1000))));
        $this->assertEquals('seribu rupiah', trim(strtolower($converter->convert(1000, true))));
        
        $this->assertEquals('sepuluh ribu', trim(strtolower($converter->convert(10000))));
        $this->assertEquals('sepuluh ribu rupiah', trim(strtolower($converter->convert(10000, true))));
        
        $this->assertEquals('satu juta', trim(strtolower($converter->convert(1000000))));
        $this->assertEquals('satu juta rupiah', trim(strtolower($converter->convert(1000000, true))));
    }
    
    public function testCurrency()
    {
        $kernel  = new KmjKernelTest('test', true);
        $kernel->boot();
        $currencyFormat = new CurrencyFormat($kernel->getContainer());
        
        $this->assertEquals("IDR", $currencyFormat->getCurrencySymbol());
        
        $currencyFormat->setCurrency("USD");
        $this->assertEquals("$", $currencyFormat->getCurrencySymbol());
        
        $this->expectExceptionMessage(sprintf("%s not supported", "IDD"));
        $currencyFormat->setCurrency("IDD");
    }
    
    public function testParsingCurrency()
    {
        $kernel  = new KmjKernelTest('test', true);
        $kernel->boot();
        $currencyFormat = new CurrencyFormat($kernel->getContainer());
        
        $this->assertEquals(10000, $currencyFormat->priceToFloat($currencyFormat->getCurrencySymbol().'10000'));
        $this->assertEquals($currencyFormat->getCurrencySymbol().' 10,000', $currencyFormat->formatPrice(10000));
    }
    
}
