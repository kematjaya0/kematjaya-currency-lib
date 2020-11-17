<?php

namespace Kematjaya\Currency\Converter;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class IndonesianConverter implements ConverterInterface
{
    
    public function convert(float $number, bool $includeCurrency = false): string 
    {
        $result = '';
        if($number < 0) {
            $result = "minus ". trim($this->terbilang($number));
        } else {
            $result = trim($this->terbilang($number));
        }
        
        return ($includeCurrency) ? trim(ucwords(strtolower($result)). " Rupiah") : trim(ucwords(strtolower($result)));
    }

    protected function terbilang(float $number):string
    {
        $number = abs($number);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($number < 12) {
            $temp = " ". $huruf[$number];
        } else if ($number <20) 
        {
            $temp = $this->terbilang($number - 10). " belas";
        } else if ($number < 100) 
        {
            $temp = $this->terbilang($number/10)." puluh". $this->terbilang($number % 10);
        } else if ($number < 200) 
        {
            $temp = " seratus" . $this->terbilang($number - 100);
        } else if ($number < 1000) 
        {
            $temp = $this->terbilang($number/100) . " ratus" . $this->terbilang($number % 100);
        } else if ($number < 2000) 
        {
            $temp = " seribu" . $this->terbilang($number - 1000);
        } else if ($number < 1000000) 
        {
            $temp = $this->terbilang($number/1000) . " ribu" . $this->terbilang($number % 1000);
        } else if ($number < 1000000000) 
        {
            $temp = $this->terbilang($number/1000000) . " juta" . $this->terbilang($number % 1000000);
        } else if ($number < 1000000000000) 
        {
            $temp = $this->terbilang($number/1000000000) . " milyar" . $this->terbilang(fmod($number,1000000000));
        } else if ($number < 1000000000000000) 
        {
            $temp = $this->terbilang($number/1000000000000) . " trilyun" . $this->terbilang(fmod($number,1000000000000));
        }     
        return $temp;
    }
}
