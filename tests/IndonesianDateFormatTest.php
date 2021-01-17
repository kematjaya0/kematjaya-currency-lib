<?php

/**
 * This file is part of the kematjaya-currency-lib.
 */

namespace Kematjaya\Currency\Tests;

use Kematjaya\Currency\Converter\IndonesianConverter;
use Kematjaya\Currency\Lib\IndonesianDateFormat;
use Kematjaya\Currency\Lib\AbstractDateFormat;
use PHPUnit\Framework\TestCase;

/**
 * @package Kematjaya\Currency\Tests
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class IndonesianDateFormatTest extends TestCase
{
    public function testInstance(): AbstractDateFormat
    {
        $converter = new IndonesianConverter();
        $format = new IndonesianDateFormat($converter);
        
        $date = new \DateTime('2021-01-17 00:00:00');
        $this->assertEquals('17 Januari 2021 00:00:00', $format->format($date, 'd M Y H:i:s'));
        $expect = 'Hari Minggu Tanggal Tujuh Belas Bulan Januari Tahun Dua Ribu Dua Puluh Satu';
        $this->assertEquals($expect, $format->convertToString($date, 'D d M Y'));
        
        return $format;
    }
}
