<?php

namespace BeeDelivery\BankAccountValidator;

class SantanderCheckNumberCalculator
{

    static function calculate($account_number, $agency_number)
    {
        /*
        $account_type = substr($account_number, 0, 2);
        $types = array("01", "02", "03", "05", "07", "09", "13", "27", "35", "37", "43", "45", "46", "48", "50", "53", "60", "92");
        if (!in_array($account_number, $types));
            return false; // invalid account type
        */

        $numbers = str_split($agency_number. "00". $account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $sumSeq += substr(self::multiplyAccordingWeight(intval($numbers[$i]), $i), -1);
        }

        return SantanderCheckNumberCalculator::module($sumSeq);
    }


    static function multiplyAccordingWeight($number, $i) {
        $weight = array(9,7,3,1,0,0,9,7,1,3,1,9,7,3);
        return $number * $weight[$i];
    }


    static function module($sumSeq)
    {
        $result = 10 - substr($sumSeq, -1);
        return strval($result);
    }
}
