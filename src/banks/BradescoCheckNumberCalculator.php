<?php

namespace App\Models;

class BradescoCheckNumberCalculator
{

    // Account validation
    static function calculateAccount($account_number) {
        $numbers = str_split($account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $number = intval($numbers[$i]);
            $sumSeq += BradescoCheckNumberCalculator::multiplyAccordingWeight($number, $i);
        }
        return BradescoCheckNumberCalculator::accountModule($sumSeq);
    }

    static function multiplyAccordingWeight($number, $i) {
        $weight = array(2,7,6,5,4,3,2);
        return $number * $weight[$i];
    }

    static function accountModule($sumSeq) {
        $module = $sumSeq % 11;
        if($module === 0) {
            return "0";
        } else {
            if ($module === 1) {
                return "P";
            } else {
                return strval(11 - $module);
            }
        }
    }

    // Agency validation
    static function calculateAgency($agencyNumber) {
        $numbers = str_split($agencyNumber);
        $sumSeq = 0;
        for ($i = 0; $i < count($numbers); $i++) {
            $seq = 5 - $i;
            $sumSeq += (intval($numbers[$i]) * $seq);
        }
          return BradescoCheckNumberCalculator::agencyModule($sumSeq);
    }

    static function agencyModule($sumSeq) {
        $result = 11 - ($sumSeq % 11);
        if($result === 10) {
            return "P";
        } else {
            if ($result === 11) {
                return "0";
            } else {
                return strval($result);
            }
        }
    }
}
