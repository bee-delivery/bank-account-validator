<?php

namespace BeeDelivery\BankAccountValidator;

class InterCheckNumberCalculator
{

    // Account validation
    static function calculateAccount($account_number)
    {
        $numbers = str_split($account_number);
        $sumSeq = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $seq = 8 - $i;
            $sumSeq += (intval($numbers[$i]) * $seq);
        }

        return InterCheckNumberCalculator::module($sumSeq);
    }

    // Account validation
    static function module($sumSeq)
    {
        $result = 11 - ($sumSeq % 11);
        if ($result > 9) {
            return "0";
        } 
        
        return strval($result);
    }
}
