<?php

namespace BankAccountValidator\src;

class BancoDoBrasilCheckNumberCalculator
{

    // Account validation
    static function calculateAccount($account_number)
    {
        $numbers = str_split($account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $seq = 9 - $i;
            $sumSeq += (intval($numbers[$i]) * $seq);
        }

        return BancoDoBrasilCheckNumberCalculator::module($sumSeq);
    }

    static function calculateAgency($agencyNumber)
    {
        $numbers = str_split($agencyNumber);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $seq = 5 - $i;
            $sumSeq += (intval($numbers[$i]) * $seq);
        }

        return BancoDoBrasilCheckNumberCalculator::module($sumSeq);
    }

    // Account validation
    static function module($sumSeq)
    {
        $result = 11 - ($sumSeq % 11);
        if ($result === 10) {
            return "X";
        } else {
            if ($result === 11) {
                return "0";
            } else {
                return strval($result);
            }
        }
    }
}
