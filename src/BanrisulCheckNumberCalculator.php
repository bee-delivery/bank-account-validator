<?php

namespace BeeDelivery\BankAccountValidator;

class BanrisulCheckNumberCalculator
{

    // Agency validation
    static function calculateAgency($agency_number)
    {
        $numbers = str_split($agency_number);
        $sumSeq = 0;
        $weight = array(1,2,1,2);
        for ($i = 0; $i < count($numbers); $i++) {
            $sumSeq += self::sum(intval($numbers[$i]) * $weight[$i]);
        }

        $mod = ($sumSeq % 10);
        if ($mod === 0)
            $digit1 = "0";
        else
            $digit1 = strval(10 - $mod);

        $numbers = str_split($agency_number . $digit1);
        $sumSeq = 0;

        $weight = array(6,5,4,3,2);
        for ($i = 0; $i < count($numbers); $i++) {
            $sumSeq += intval($numbers[$i]) * $weight[$i];
        }

        $mod = ($sumSeq % 11);
        $reDoCalc = false;
        if ($mod === 1 && $digit1 != "9") {
            $digit2 = strval($mod + 1);
            $reDoCalc = true;
        }
        else if ($mod === 1 && $digit1 == "9") {
            $digit1 = "0";
            $digit2 = "1";
            $reDoCalc = true;
        }
        else if ($mod === 0)
            $digit2 = "0";
        else
            $digit2 = strval(11 - $mod);

        return $digit1 . $digit2;
    }

    static private function sum($num) {
        $sum = 0;
        $rem = 0;
        for ($i = 0; $i <= strlen($num); $i++) {
            $rem = $num % 10;
            $sum = $sum + $rem;
            $num = $num / 10;
        }
        return $sum;
    }

    // Account validation
    static function calculateAccount($account_number)
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
