<?php

namespace BeeDelivery\BankAccountValidator;

class HSBCCheckNumberCalculator
{

    static function calculate($account_number, $agency_number)
    {
        $numbers = str_split($agency_number . $account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $sumSeq += self::multiplyAccordingWeight(intval($numbers[$i]), $i);
        }

        return self::module($sumSeq);
    }


    static function multiplyAccordingWeight($number, $i) {
        $weight = array(8,9,2,3,4,5,6,7,8,9);
        return $number * $weight[$i];
    }


    static function module($sumSeq)
    {
        $result = $sumSeq % 11;
        if($result === 10) {
            return "0";
        } else {
            return strval($result);
        }
    }
}
