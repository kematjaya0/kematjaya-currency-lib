<?php

namespace Kematjaya\Tests\Currency;

use Kematjaya\Currency\CurrencyFormat;
use PHPUnit\Framework\TestCase;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class CurrencyFormatTest extends TestCase {
    
    public function testConvert()
    {
        $cr = new CurrencyFormat();
        $this->assertEquals('seratus', trim(strtolower($cr->convert(100))));
    }
}
