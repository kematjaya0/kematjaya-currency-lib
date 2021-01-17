<?php

namespace Kematjaya\Currency\Tests\Currency;

use Kematjaya\Currency\Tests\AppKernelTest;
use Kematjaya\Currency\Lib\CurrencyFormatInterface;
use Kematjaya\Currency\Twig\PriceExtension;
use Kematjaya\Currency\Twig\ConverterExtension;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceExtensionTest extends WebTestCase
{
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
    
    public function testContainer(): ContainerInterface
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertInstanceOf(ContainerInterface::class, $container);
        
        return $container;
    }
    
    /**
     * @depends testContainer
     * @param ContainerInterface $container
     * @return CurrencyFormatInterface
     */
    public function testInstance(ContainerInterface $container): CurrencyFormatInterface
    {
        $this->assertTrue($container->has('kmj.currency_format'));
        
        return $container->get('kmj.currency_format');
    }
    
    /**
     * @depends testInstance
     * @param CurrencyFormatInterface $currencyFormat
     */
    public function testFormatPrice(CurrencyFormatInterface $currencyFormat)
    {
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
