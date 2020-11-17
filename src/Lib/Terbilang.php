<?php

namespace Kematjaya\Currency\Lib;

use Kematjaya\Currency\Contract\Messages;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Terbilang 
{
    public function __construct() 
    {
        $package = self::class;
        $version = "2.0";
        $message = "use Kematjaya\Currency\ConverterInterface instead";
        Messages::triggerDeprecation(self::class, "2.0", "use Kematjaya\Currency\ConverterInterface instead");
    }
    
    public function convertToString($number, $curency = null) 
    {
        $hasil = '';
        if($number < 0) {
            $hasil = "minus ". trim($this->convert($number));
        } else {
            $hasil = trim($this->convert($number));
        }
                
        $mataUang = "";
        switch($curency) {
            case "IDR":
                $mataUang = "Rupiah";
                break;
            case "USD":
                $mataUang = "Dollar";
                break;
            default:
                break;
        }
        return trim(ucwords(strtolower($hasil)). " " . $mataUang);
    }
    
    public function convert($nilai)
    {
        // sumber : https://www.malasngoding.com/cara-mudah-membuat-fungsi-terbilang-dengan-php/
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
                $temp = $this->convert($nilai - 10). " belas";
        } else if ($nilai < 100) {
                $temp = $this->convert($nilai/10)." puluh". $this->convert($nilai % 10);
        } else if ($nilai < 200) {
                $temp = " seratus" . $this->convert($nilai - 100);
        } else if ($nilai < 1000) {
                $temp = $this->convert($nilai/100) . " ratus" . $this->convert($nilai % 100);
        } else if ($nilai < 2000) {
                $temp = " seribu" . $this->convert($nilai - 1000);
        } else if ($nilai < 1000000) {
                $temp = $this->convert($nilai/1000) . " ribu" . $this->convert($nilai % 1000);
        } else if ($nilai < 1000000000) {
                $temp = $this->convert($nilai/1000000) . " juta" . $this->convert($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
                $temp = $this->convert($nilai/1000000000) . " milyar" . $this->convert(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
                $temp = $this->convert($nilai/1000000000000) . " trilyun" . $this->convert(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
    
}
