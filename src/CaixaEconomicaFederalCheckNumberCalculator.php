<?php

namespace BeeDelivery\BankAccountValidator;

class CaixaEconomicaFederalCheckNumberCalculator
{

    // Account validation
    static function calculateAccount($account_number, $agency_number) {
        $numbers = $agency_number . substr($account_number, 0, 3);
        $sumSeq = 0;

        for ($i = 0; $i < strlen($numbers); $i++) {
            $number = intval($numbers[$i]);
            $sumSeq += CaixaEconomicaFederalCheckNumberCalculator::multiplyAccordingWeightAgency($number, $i);
        }

        $numbers = substr($account_number, 3);

        for ($i = 0; $i < strlen($numbers); $i++) {
            $number = intval($numbers[$i]);
            $sumSeq += CaixaEconomicaFederalCheckNumberCalculator::multiplyAccordingWeightAccount($number, $i);
        }

        return CaixaEconomicaFederalCheckNumberCalculator::module($sumSeq);
    }

    static function multiplyAccordingWeightAgency($number, $i) {
        $weight = array(8,7,6,5,4,3,2);
        return $number * $weight[$i];
    }

    static function multiplyAccordingWeightAccount($number, $i) {
        $weight = array(2,9,8,7,6,5,4,3,2);
        return $number * $weight[$i];
    }

    static function module($sumSeq) {
        $module = ($sumSeq * 10) % 11;
        if($module > 9) {
            return "0";
        } else {
            return strval($module);
        }
    }
}
