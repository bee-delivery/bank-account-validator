<?php

namespace App\Models;

class BanrisulCheckNumberCalculator
{

    // Account validation
    static function calculate($account_number)
    {
        $numbers = str_split($account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $number = intval($numbers[$i]);
            $sumSeq += BanrisulCheckNumberCalculator::multiplyAccordingWeight($number, $i);
        }

        return BanrisulCheckNumberCalculator::moduleEleven($sumSeq);
    }

    static function multiplyAccordingWeight($number, $index) {

        $weight = array(3,2,4,7,6,5,4,3,2);
        return $number * $weight[$index];
    }

    static function moduleEleven($sumSeq) {
        $module = $sumSeq % 11;
        if ($module === 0) {
            return 0;
        } else if ($module == 1) {
            return 6;
        }
        return 11 - $module;
    }

}
