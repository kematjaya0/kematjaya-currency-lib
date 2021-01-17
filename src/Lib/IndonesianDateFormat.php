<?php

/**
 * This file is part of the kematjaya-currency-lib.
 */

namespace Kematjaya\Currency\Lib;

/**
 * @package Kematjaya\Currency\Lib
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class IndonesianDateFormat extends AbstractDateFormat
{
    /**
     * 
     * @param string $day
     * @return string
     */
    public function getDayName(string $day):string
    {
        $date = ['Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Sun' => 'Minggu'];
        
        return (isset($date[$day])) ? $date[$day] : $day;
    }
    
    /**
     * 
     * @param string $month
     * @return string
     */
    public function getMonthName(string $month):string
    {
        $bulan = [
            'Jan' => 'Januari', 'Feb' => 'Februari', 'Mar' => 'Maret',  'Apr' => 'April',
            'May' => 'Mei',     'Jun' => 'Juni',     'Jul' => 'Juli',   'Aug' => 'Agustus',
            'Sep' => 'September', 'Oct' => 'Oktober', 'Nov' => 'November', 'Dec' => 'Desember'
        ];
        
        return (isset($bulan[$month])) ? $bulan[$month] : $month;
    }
    
    public function getLabels():array
    {
        return [
            'D' => 'Hari', 'd' => 'Tanggal', 'M' => 'Bulan', 'Y' => 'Tahun'
        ];
    }
}
