<?php

/**
 * This file is part of the kematjaya-currency-lib.
 */

namespace Kematjaya\Currency\Lib;

/**
 * @package Kematjaya\Currency\Lib
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface CurrencyFormatInterface 
{
    /**
     * Decode price string to float
     * @param string $price
     * @return float
     */
    public function priceToFloat(string $price = ''):float;
    
    /**
     * Encode / formatting floating number to price format
     * @param float $number
     * @return string
     */
    public function formatPrice(float $number = 0):string;
    
    public function getCurrencySymbol():?string;
}
