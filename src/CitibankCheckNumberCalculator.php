<?php

namespace BeeDelivery\BankAccountValidator;

class CitibankCheckNumberCalculator
{

    static function calculate($account_number)
    {
        $numbers = str_split($account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $sumSeq += self::multiplyAccordingWeight(intval($numbers[$i]), $i);
        }

        return self::module($sumSeq);
    }


    static function multiplyAccordingWeight($number, $i) {
        $weight = array(11,10,9,8,7,6,5,4,3,2);
        return $number * $weight[$i];
    }


    static function module($sumSeq)
    {
        $result = 11 - ($sumSeq % 11);
        return strval($result);
    }
}
