<?php

namespace App\Models;

class ItauCheckNumberCalculator
{

    // Account validation
    static function calculate($agencyNumber, $accountNumber) {
        $numbers = str_split($agencyNumber . $accountNumber);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $number = intval($numbers[$i]);
            $sequence = ItauCheckNumberCalculator::multiplyAccordingParity($number, $i);
            $sequence = ItauCheckNumberCalculator::adjustAccordingLength($sequence);
            $sumSeq += $sequence;
        }

        return ItauCheckNumberCalculator::module($sumSeq);
    }

    static function multiplyAccordingParity($number, $index) {
        return $number * ($index % 2 === 0 ? 2 : 1);
    }

    static function adjustAccordingLength($sequence) {
        if($sequence > 9) {
            $numbers = str_split(strval($sequence));
            $sequence = 0;
            for ($i = 0; $i < count($numbers); $i++) {
                $sequence += intval($numbers[$i]);
            }
          }
        return $sequence;
    }

    static function module($sumSeq) {
        $module = $sumSeq % 10;
        if($module === 0) {
            return "0";
        } else {
            return strval(10 - $module);
        }
    }
}
